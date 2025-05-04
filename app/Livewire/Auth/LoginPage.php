<?php

namespace App\Livewire\Auth;

use Livewire\Component;

#[Title('Login')]
class LoginPage extends Component
{

    public $email, $password;

    public function save() {
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255',
            'password' => 'required|min:8|max:255',]);

        if(!auth()->attempt(['email' => $this->email, 'password' => $this->password])){
            session()->flash('error', 'Email atau password salah');
            return; 
        }

        return redirect()->intended();
    }

    public function render(){
        return view('livewire.auth.login-page');
    }
}
