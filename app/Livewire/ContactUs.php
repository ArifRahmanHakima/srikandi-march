<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Component
{
    public $name, $email, $message, $successMessage, $errorMessage;

    protected $rules = [
        'name' => 'required|min:2|max:100',
        'email' => 'required|email|max:255',
        'message' => 'required|min:10|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'name.min' => 'Nama minimal 2 karakter.',
        'name.max' => 'Nama maksimal 100 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 255 karakter.',
        'message.required' => 'Pesan wajib diisi.',
        'message.min' => 'Pesan minimal 10 karakter.',
        'message.max' => 'Pesan maksimal 1000 karakter.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        // Clear messages when user starts typing
        if ($this->successMessage) {
            $this->successMessage = '';
        }
        if ($this->errorMessage) {
            $this->errorMessage = '';
        }
    }

    public function sendMessage()
    {
        $this->validate();

        try {
            // Log untuk debugging
            Log::info('Attempting to send contact email', [
                'name' => $this->name,
                'email' => $this->email,
                'message_length' => strlen($this->message)
            ]);

            // Kirim email dengan alamat tujuan yang benar
            Mail::to(env('CONTACT_EMAIL', '3srikandimerchofficial@gmail.com'))
                ->send(new ContactUsMail($this->name, $this->email, $this->message));

            Log::info('Contact email sent successfully');

            // Reset form
            $this->reset(['name', 'email', 'message', 'errorMessage']);
           
            // Set success message
            $this->successMessage = 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.';

        } catch (\Exception $e) {
            $this->errorMessage = 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi.';
           
            // Log error untuk debugging dengan detail lengkap
            Log::error('Contact form error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}