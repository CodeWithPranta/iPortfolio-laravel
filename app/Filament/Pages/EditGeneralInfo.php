<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\GeneralInfo;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;

class EditGeneralInfo extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-general-info';

    public function mount(): void
    {
        $generalInfo = GeneralInfo::first();

        if ($generalInfo) {
            // Check if 'social_links' is a JSON string and decode it to an array
            $socialLinks = is_string($generalInfo->social_links) ? json_decode($generalInfo->social_links, true) : $generalInfo->social_links;

            // Update the 'social_links' attribute with the decoded array
            $generalInfo->social_links = $socialLinks;

            // Now you can fill the form with the attributes
            $this->form->fill($generalInfo->attributesToArray());
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
                    FileUpload::make('avatar')
                        ->label('Avatar (600 by 600)px')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '1:1',
                        ])
                        ->required(),
                    FileUpload::make('background_image')
                        ->label('Background image (1920 by 1280)px')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->required(),
                    FileUpload::make('favicon')
                        ->label('Favicon PNG (32 by 32)px')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '1:1',
                        ])
                        ->required(),
                    FileUpload::make('apple_touch_icon')
                        ->label('Apple Touch PNG (180 by 180)px')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '1:1',
                        ])
                        ->required(),
                ]),

                Grid::make([
                    'default' => 1,
                    'sm' => 2,
                ])
                ->schema([
                    TextInput::make('title')
                        ->minLength(3)
                        ->maxLength(500)
                        ->required()
                        ->columnSpan(2),
                    Textarea::make('meta_description')
                        ->columnSpan(2)
                        ->required(),
                    Textarea::make('keywords')
                        ->columnSpan(2)
                        ->required(),
                ]),

                Repeater::make('social_links')
                    ->schema([
                        TextInput::make('name')
                          ->placeholder('e.g. facebook'),
                        TextInput::make('url')
                          ->placeholder('e.g. https://facebook.com/webmastermazumder')
                          ->url(),
                    ])
                    ->grid(2)
                    ->minItems(2)
                    ->maxItems(6)
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
        $existingGeneralInfo = GeneralInfo::first();

        if ($existingGeneralInfo) {
            // If an existing record was found, update it with the new data
            $data['social_links'] = json_encode($data['social_links']); // Convert to JSON string
            $existingGeneralInfo->update($data);
        } else {
            // If no existing record was found, create a new one
            $data['social_links'] = json_encode($data['social_links']); // Convert to JSON string
            GeneralInfo::create($data);
        }


        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
