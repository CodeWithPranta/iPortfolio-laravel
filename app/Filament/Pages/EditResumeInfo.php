<?php

namespace App\Filament\Pages;

use App\Models\Resume;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class EditResumeInfo extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static string $view = 'filament.pages.edit-resume-info';

    public ?array $data = [];

    public function mount(): void
    {
        $resumeInfo = Resume::first();

        if ($resumeInfo) {
            // Check if data fields are JSON string and decode it to an array
            $resume_contact_lists = is_string($resumeInfo->resume_contact_lists) ? json_decode($resumeInfo->resume_contact_lists, true) : $resumeInfo->resume_contact_lists;
            $educations = is_string($resumeInfo->educations) ? json_decode($resumeInfo->educations, true) : $resumeInfo->educations;
            $experiences = is_string($resumeInfo->experiences) ? json_decode($resumeInfo->experiences, true) : $resumeInfo->experiences;
            // Update the database fields attribute with the decoded array
            $resumeInfo->resume_contact_lists = $resume_contact_lists;
            $resumeInfo->educations = $educations;
            $resumeInfo->experiences = $experiences;

            // Now you can fill the form with the attributes
            $this->form->fill($resumeInfo->attributesToArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
          ->schema([

            Textarea::make('resume_short_description')->rows('5')->required(),
            Textarea::make('text_after_name')->rows('5')->required(),

            Repeater::make('resume_contact_lists')
                  ->schema([
                    TextInput::make('value')->minLength(2)->required()->unique(ignoreRecord:true),
                  ])
                  ->grid(2)
                  ->minItems(2)
                  ->maxItems(5)
                  ->required(),
            Repeater::make('educations')
                  ->schema([
                    TextInput::make('title')->minLength(2)->required()->unique(ignoreRecord:true),
                    DatePicker::make('start_date')->required(),
                    DatePicker::make('end_date')->label('End date(Keep it blank to show "Present")'),
                    TextInput::make('institute_name')->minLength(3)->maxLength(500)->required(),
                    RichEditor::make('content')->required(),
                  ])
                  ->grid(2)
                  ->minItems(2)
                  ->maxItems(5)
                  ->required(),
            Repeater::make('experiences')
                  ->schema([
                    TextInput::make('title')->minLength(2)->required()->unique(ignoreRecord:true),
                    DatePicker::make('start_date')->required(),
                    DatePicker::make('end_date')->label('End date(Keep it blank to show "Present")'),
                    TextInput::make('industry_name')->minLength(3)->maxLength(500)
                       ->required()->placeholder("Homestaurant's, Rennes, France"),
                    RichEditor::make('content')->required(),
                  ])
                  ->grid(2)
                  ->minItems(2)
                  ->maxItems(5)
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

        // Attempt to find an existing record
        $existingResumeInfo = Resume::first();

        if ($existingResumeInfo) {
            // If an existing record was found, update it with the new data
            $data['resume_contact_lists'] = json_encode($data['resume_contact_lists']); // Convert to JSON string
            $data['educations'] = json_encode($data['educations']);
            $data['experiences'] = json_encode($data['experiences']);
            $existingResumeInfo->update($data);
        } else {
            // If no existing record was found, create a new one
            $data['resume_contact_lists'] = json_encode($data['resume_contact_lists']);
            $data['educations'] = json_encode($data['educations']);
            $data['experiences'] = json_encode($data['experiences']);
            Resume::create($data);
        }


        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
