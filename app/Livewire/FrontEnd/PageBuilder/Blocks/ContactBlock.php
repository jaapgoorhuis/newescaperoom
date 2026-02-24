<?php

namespace App\Livewire\Frontend\PageBuilder\Blocks;

use Livewire\Component;

class ContactBlock extends Component
{
    public $blockId;
    public $contact = [
        'name' => '',
        'email' => '',
        'message' => '',
    ];
    public $successMessage;

    public function mount($blockId)
    {

        $this->blockId = $blockId;
    }

    public function submitContactForm()
    {
        $this->validate([
            'contact.name' => 'required|string',
            'contact.email' => 'required|email',
            'contact.message' => 'required|string',
        ]);

        // Hier kan je opslaan naar database of email versturen
        // Bijvoorbeeld Mail::to('admin@example.com')->send(new ContactMail($this->contact));

        $this->successMessage = 'Bedankt! Je bericht is verzonden.';
        $this->contact = ['name' => '', 'email' => '', 'message' => ''];
    }

    public function render()
    {
        dd('test');
        return view('livewire.frontend.pagebuilder.blocks.contact');
    }
}
