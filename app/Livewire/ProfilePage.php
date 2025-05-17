<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePage extends Component
{
    use WithFileUploads;
    
    // User profile details
    public $user;
    public $name;
    public $email;
    public $phone;
    public $bio;
    public $newProfilePhoto;
    
    // Address details
    public $country;
    public $city;
    public $state;
    public $codePost;
    public $streetAddress;
    
    // Combined fields for display
    public $cityState;
    
    // Form validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'bio' => 'nullable|string|max:1000',
        'newProfilePhoto' => 'nullable|image|max:5024', // 5MB Max
        'country' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'codePost' => 'nullable|string|max:20',
        'streetAddress' => 'nullable|string|max:255',
    ];
    
    public function mount()
    {
        $this->user = Auth::user();
        $this->loadUserData();
    }
    
    public function loadUserData()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->bio = $this->user->bio;
        
        // Address fields
        $this->country = $this->user->country;
        $this->city = $this->user->city;
        $this->state = $this->user->state;
        $this->codePost = $this->user->code_post;
        $this->streetAddress = $this->user->street_address;
        
        // Combined display fields
        $this->cityState = $this->user->cityState;
    }
    
    public function updatePersonalInfo()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'newProfilePhoto' => 'nullable|image|max:5024',
        ]);
        
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->phone = $this->phone;
        $this->user->bio = $this->bio;
        
        // Handle profile photo upload if provided
        if ($this->newProfilePhoto) {
            // Delete old profile photo if exists
            if ($this->user->profile_photo_path) {
                Storage::delete($this->user->profile_photo_path);
            }
            
            // Store the new profile photo
            $path = $this->newProfilePhoto->store('profile-photos', 'public');
            $this->user->profile_photo_path = $path;
        }
        
        $this->user->save();
        
        session()->flash('message', 'Informasi pribadi berhasil diperbarui!');
        
        // Force a complete refresh to ensure the image is updated in the browser
        $this->redirect(request()->header('Referer'));
    }
    
    public function updateAddress()
    {
        $this->validate([
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'codePost' => 'nullable|string|max:20',
            'streetAddress' => 'nullable|string|max:255',
        ]);
        
        $this->user->country = $this->country;
        $this->user->city = $this->city;
        $this->user->state = $this->state;
        $this->user->code_post = $this->codePost;
        $this->user->street_address = $this->streetAddress;
        
        $this->user->save();
        
        // Reload user data to refresh the view
        $this->cityState = trim($this->city . ' ' . $this->state);
        
        session()->flash('message', 'Alamat berhasil diperbarui!');
    }
    
    public function render()
    {
        return view('livewire.profile-page');
    }
}