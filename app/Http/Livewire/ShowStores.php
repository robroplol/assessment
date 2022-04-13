<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Journal;

class ShowStores extends Component
{
    public $user;
    public $brands;
    public $stores;
    public $total_profit;
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

    public function exportCsv($id)
    {
        $store = Store::find($id);
        //dd($store->journals);
        $headers = array(
            'Content-Type' => 'text/csv'
        );
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }
        $filename =  public_path('files/store-' . $store->number . '-' . date("Y-m-d") . '-export.csv');
        //dd($filename);
        $handle = fopen($filename, 'w');
        fputcsv($handle, [
            "Date",
            "Revenue",
            "Labor Cost",
            "Food Cost",
            "Profit"
        ]);
        foreach ($store->journals as $journal) {
            fputcsv($handle, [
                $journal->date,
                $journal->revenue,
                $journal->labor_cost,
                $journal->food_cost,
                $journal->profit,
            ]);
        }
        return Response::download($filename, "download.csv", $headers);

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
