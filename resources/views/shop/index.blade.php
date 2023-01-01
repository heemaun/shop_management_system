<div id="shops_index" class="shops-index">
    <div class="top">
        <input type="text" name="search" id="shops_index_search" class="form-control" placeholder="seach shops name">
        <a href="{{ route('shops.create') }}" id="shops_index_create" class="btn btn-success">Create</a>
    </div>
    <div id="shops_index_table_container" class="table-container">
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
    </div>
</div>
