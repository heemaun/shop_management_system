@if (count($shops) < 1)
<span class="index-error">No data found!!</span>
@else
<table class="table table-dark table-bordered">
    <thead>
        <th>Name</th>
        <th>Created At</th>
        <th>Updated At</th>
    </thead>
    <tbody>
        @foreach ($shops as $shop)
        <tr class="clickable" data-href="{{ route('shops.show',$shop->id) }}">
            <td>{{ $shop->shop_name }}</td>
            <td>{{ $shop->created_at->diffForHumans() }}</td>
            <td>{{ $shop->updated_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
