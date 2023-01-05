@if (count($sells) < 1)
<span class="index-error">No data found!!</span>
@else
<table class="table table-dark table-bordered">
    <thead>
        <th>Date</th>
        <th>Customer</th>
        <th>Status</th>
        <th>Total Price</th>
    </thead>
    <tbody>
        @foreach ($sells as $sell)
        <tr class="clickable" data-href="{{ route('sells.show',$sell->id) }}">
            <td>{{ date('Y-m-d h:m:s a',strtotime($sell->created_at)) }}</td>
            <td>{{ $sell->customer->name }}</td>
            <td>{{ ucwords($sell->status) }}</td>
            <td>{{ $sell->total_price - $sell->less + $sell->vat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
