<?php

namespace App\Filament\Pages;

use App\Models\Fact;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class EditFactInfo extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static string $view = 'filament.pages.edit-fact-info';

    public ?array $data = [];

    public function mount(): void
    {
        $factInfo = Fact::first();

        if ($factInfo) {
            // Check if 'infos' is a JSON string and decode it to an array
            $infos = is_string($factInfo->infos) ? json_decode($factInfo->infos, true) : $factInfo->infos;

            // Update the 'infos' attribute with the decoded array
            $factInfo->infos = $infos;

            // Now you can fill the form with the attributes
            $this->form->fill($factInfo->attributesToArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                   Textarea::make('fact_short_description')->required(),
                   Repeater::make('infos')
                    ->schema([
                        TextInput::make('icon')
                          ->label('Bi Bi Icon')
                          ->placeholder("e.g. <i class='bi bi-apple'></i>")
                          ->required(),
                        TextInput::make('number')
                          ->numeric()
                          ->required(),
                        TextInput::make('title')->required(),
                        TextInput::make('subtitle')->required(),
                    ])
                    ->grid(2)
                    ->minItems(2)
                    ->maxItems(4)
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

        // Attempt to find an existing GeneralInfo record
        $existingFactInfo = Fact::first();

        if ($existingFactInfo) {
            // If an existing record was found, update it with the new data
            $data['infos'] = json_encode($data['infos']); // Convert to JSON string
            $existingFactInfo->update($data);
        } else {
            // If no existing record was found, create a new one
            $data['infos'] = json_encode($data['infos']); // Convert to JSON string
            Fact::create($data);
        }


        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
