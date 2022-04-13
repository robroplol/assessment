<div>
    <select name="" id="" wire:model="selectedBrands">
        <option value="0">All Brands</option>
        @foreach ($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
        @endforeach
    </select>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
        @if (count($stores) == 0)
            <h2>You don't have any stores for this brand.</h2>
        @else
        @foreach ($stores as $store)
            @foreach($store->journals as $journal)
                @php
                $total_profit += $journal->profit;
                @endphp
            @endforeach
        <div class="p-8">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-2xl">{{$store->brand->name}} Store #{{$store->number}}</h2>
                    <p>Total Profit: ${{number_format($total_profit, 0, ".", ",")}}</p>
                </div>
                <img src="{{ $store->brand->logo_file }}" alt="" width="64">
            </div>
            <table class="w-full mb-4">
                <tr>
                    <td>Date</td>
                    <td>Revenue</td>
                    <td>Labor Cost</td>
                    <td>Food Cost</td>
                    <td>Profit</td>
                </tr>
                @foreach ($store->journals as $journal)
                    <tr>
                        <td>{{$journal->date}}</td>
                        <td>${{$journal->revenue}}</td>
                        <td>${{$journal->labor_cost}}</td>
                        <td>${{$journal->food_cost}}</td>
                        <td>${{$journal->profit}}</td>
                    </tr>
                @endforeach
            </table>
            <button wire:click="exportCsv({{$store->id}})" class="py-4 px-8 text-white" style="background-color: {{$store->brand->color}} ;">Export Store Data as CSV</button>
        </div>
        @endforeach
        @endif
    </div>
</div>
