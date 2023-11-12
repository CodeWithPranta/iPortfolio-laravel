<?php

namespace App\Filament\Pages;

use App\Models\Skill;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class EditSkillInfo extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static string $view = 'filament.pages.edit-skill-info';

    public ?array $data = [];

    public function mount(): void
    {
        $skillInfo = Skill::first();

        if ($skillInfo) {
            // Check if 'social_links' is a JSON string and decode it to an array
            $topics = is_string($skillInfo->topics) ? json_decode($skillInfo->topics, true) : $skillInfo->topics;

            // Update the 'social_links' attribute with the decoded array
            $skillInfo->topics = $topics;

            // Now you can fill the form with the attributes
            $this->form->fill($skillInfo->attributesToArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
          ->schema([

            Textarea::make('skill_short_description')->rows('5')->required(),

            Repeater::make('topics')
                  ->schema([
                    TextInput::make('name')->minLength(2)->required()->unique(ignoreRecord:true),
                    TextInput::make('efficiency_in_percentage')->numeric()->required(),
                  ])
                  ->grid(2)
                  ->minItems(4)
                  ->maxItems(16)
                  ->required(),

          ])
          ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        // Retrieve the data from the form
        $data = $this->form->getState();

        // Attempt to find an existing skillInfo record
        $existingSkillInfo = Skill::first();

        if ($existingSkillInfo) {
            // If an existing record was found, update it with the new data
            $data['topics'] = json_encode($data['topics']); // Convert to JSON string
            $existingSkillInfo->update($data);
        } else {
            // If no existing record was found, create a new one
            $data['topics'] = json_encode($data['topics']); // Convert to JSON string
            Skill::create($data);
        }


        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
