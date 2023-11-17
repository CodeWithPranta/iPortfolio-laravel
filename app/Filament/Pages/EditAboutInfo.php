<?php

namespace App\Filament\Pages;

use App\Models\About;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class EditAboutInfo extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static string $view = 'filament.pages.edit-about-info';

    public function mount(): void
    {
        $aboutInfo = About::first();

        if ($aboutInfo)
        {
            // Decode dynamic texts into an array
             $dynamicTexts = is_string($aboutInfo->dynamic_texts) ? json_decode($aboutInfo->dynamic_texts, true) : $aboutInfo->dynamic_texts;
            // Update the 'dynamic_texts' attribute with the decoded array
            $aboutInfo->dynamic_texts = $dynamicTexts;

            $this->form->fill($aboutInfo->attributesToArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make([
                'default' => 1,
                'sm' => 2,
            ])
            ->schema([
                TextInput::make('full_name')
                  ->minLength(3)
                  ->maxLength(255)
                  ->required(),
                TextInput::make('professional_title')
                  ->minLength(3)
                  ->maxLength(255)
                  ->required(),
                Textarea::make('about_short_description')
                  ->required(),
                Textarea::make('profession_description')
                  ->required(),
                DatePicker::make('birthday')
                  ->required(),
                TextInput::make('age')
                  ->numeric()
                  ->required(),
                TextInput::make('website')
                  ->url()
                  ->required()
                  ->placeholder('e.g. https://codewithpranta.com'),
                TextInput::make('degree')
                  ->minLength(2)
                  ->maxLength(255)
                  ->required()
                  ->placeholder('e.g. Master\'s in Computer Science'),
                TextInput::make('phone')
                  ->tel()
                  ->required(),
                TextInput::make('email')
                  ->email()
                  ->required(),
                TextInput::make('address')
                  ->label('City')
                  ->placeholder('e.g. Khulna, Bangladesh')
                  ->required(),
                Radio::make('freelance')
                  ->required()
                  ->boolean(),
            ]),
            Repeater::make('dynamic_texts')
                  ->label('Dynamic texts in hero section')
                  ->schema([
                      TextInput::make('profession')
                        ->placeholder('e.g. Full-stack Developer'),
                  ])
                  ->grid(2)
                  ->minItems(2)
                  ->maxItems(6)
                  ->required()
                  ->columnSpan(2),

            Textarea::make('about_yourself')
                ->rows(7)
                ->cols(20)
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
        $existingAboutInfo = About::first();

        if ($existingAboutInfo) {
            // If an existing record was found, update it with the new data
            $data['dynamic_texts'] = json_encode($data['dynamic_texts']); // Convert to JSON string
            $existingAboutInfo->update($data);
        } else {
            // If no existing record was found, create a new one
            $data['dynamic_texts'] = json_encode($data['dynamic_texts']); // Convert to JSON string
            About::create($data);
        }


        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

}
