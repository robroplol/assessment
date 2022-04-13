<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Journal;

class ShowStores extends Component
{
    public $user;
    public $brands;
    public $stores;
    public $selectedBrands = 0;
    
    public function updatedSelectedBrands()
    {
        ($this->selectedBrands);  
        if ($this->selectedBrands == 0) {
            $this->stores = Store::where('user_id', $this->user->id)->get();
        } else {
            $this->stores = Store::where('user_id', $this->user->id)->where('brand_id', $this->selectedBrands)->get();
        }
    }

    public function mount()
    {
        $this->user=Auth::user();
        $this->stores = Store::where('user_id', $this->user->id)->get();
        $this->brands = Brand::all();
    }

    public function render()
    {
        return view('livewire.show-stores');
    }
}
