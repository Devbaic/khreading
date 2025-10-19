<?php

namespace App\Livewire;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|min:2',
        'email' => 'required|email',
        'message' => 'required|string|min:5',
    ];

    public function submit()
    {
        // Validate input
        $validated = $this->validate();

        // Prepare mail data
        $mailData = [
            'subject' => 'You have received a contact email',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ];

        // Send the email
        Mail::to('klluy730@gmail.com')->send(new ContactEmail($mailData));

        // Flash success message
        session()->flash('success', 'Thanks for contacting us! We will get back to you soon.');

        // Optionally clear inputs (better UX)
        $this->reset(['name', 'email', 'message']);

        // Redirect or stay on same page
        // return redirect()->route('contact'); // if you have a named route
        // OR simply:
        $this->dispatch('formSubmitted');
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
