<?php

namespace App\Filament\Pages;

use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class EditContactInfo extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static string $view = 'filament.pages.edit-contact-info';

    public ?array $data = [];

    public function mount(): void
    {
        $contactInfo = Contact::first();

        if ($contactInfo) {
            // Now you can fill the form with the attributes
            $this->form->fill($contactInfo->attributesToArray());
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
                    Textarea::make('contact_short_description')->rows('3')->columnSpanFull()->required(),
                    TextInput::make('email')->required()->email(),
                    TextInput::make('phone')->tel()->required(),
                    TextInput::make('address')->minLength(3)->maxLength(500)->required()->columnSpanFull(),
                    Textarea::make('google_map_link')->columnSpanFull()->placeholder('e.g. https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.555476452171!2d89.36521017499604!3d22.744758026639126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff79f7d101e0f3%3A0x8985187ebcef3e85!2sBaruikati%20Bazar%2CDumuria%2CKhulna!5e0!3m2!1sen!2sbd!4v1699916424714!5m2!1sen!2sbd')->required(),
                ]),

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
        $existingContactInfo = Contact::first();

        if ($existingContactInfo) {
            // If an existing record was found, update it with the new data
            $existingContactInfo->update($data);
        } else {
            // If no existing record was found, create a new one
            Contact::create($data);
        }


        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
