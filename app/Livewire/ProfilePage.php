<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePage extends Component
{
    public $user, $name, $email, $phone, $bio, $newProfilePhoto;
    public $province, $city, $subdistrict, $postal_code, $street_address, $citysubdistrict;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'bio' => 'nullable|string|max:1000',
        'newProfilePhoto' => 'nullable|image|max:5024',
        'province' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'subdistrict' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:20',
        'street_address' => 'nullable|string|max:255',
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
        
        $this->province = $this->user->province;
        $this->city = $this->user->city;
        $this->subdistrict = $this->user->subdistrict;
        $this->postal_code = $this->user->postal_code;
        $this->street_address = $this->user->street_address;
        $this->citysubdistrict = $this->user->citysubdistrict;
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
        
        if ($this->newProfilePhoto) {
            if ($this->user->profile_photo_path) {
                Storage::delete($this->user->profile_photo_path);
            }
            
            $path = $this->newProfilePhoto->store('profile-photos', 'public');
            $this->user->profile_photo_path = $path;
        }
        
        $this->user->save();
        
        session()->flash('message', 'Informasi pribadi berhasil diperbarui!');
        
        $this->redirect(request()->header('Referer'));
    }
    
    public function updateAddress()
    {
        $this->validate([
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'subdistrict' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'street_address' => 'nullable|string|max:255',
        ]);
        
        $this->user->province = $this->province;
        $this->user->city = $this->city;
        $this->user->subdistrict = $this->subdistrict;
        $this->user->postal_code = $this->postal_code;
        $this->user->street_address = $this->street_address;
        
        $this->user->save();
        
        // Reload user data to refresh the view
        $this->citysubdistrict = trim($this->city . ' ' . $this->subdistrict);
        
        session()->flash('message', 'Alamat berhasil diperbarui!');
    }
    
    public function render()
    {
        return view('livewire.profile-page');
    }
}