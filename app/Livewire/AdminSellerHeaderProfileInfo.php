<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class AdminSellerHeaderProfileInfo extends Component
{
    public $admin;
    public $seller;

    public $listeners = [
        'updateAdminSellerHeaderInfo'=>'$refresh'
    ];

    public function mount(){
        // Menggunakan id() dari guard masing-masing, dan memakai find() agar tidak crash
        if( Auth::guard('admin')->check() ){
            $this->admin = Admin::find(Auth::guard('admin')->id());
        }
        if( Auth::guard('seller')->check() ){
            $this->seller = Seller::find(Auth::guard('seller')->id());
        }
    }
    
    public function render()
    {
        return view('livewire.admin-seller-header-profile-info');
    }
}