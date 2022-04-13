<div>
    <select name="" id="" wire:model="selectedBrands">
        <option value="0">All Brands</option>
        @foreach ($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
        @endforeach
    </select>
    @foreach ($stores as $store)
        <h2 class="text-2xl">Store {{$store->number}}</h2>
        <h3 class="text-xl">{{$store->brand->name}}</h3>
        <table>
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
                    <td>{{$journal->revenue}}</td>
                    <td>{{$journal->labor_cost}}</td>
                    <td>{{$journal->food_cost}}</td>
                    <td>{{$journal->profit}}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
</div>
