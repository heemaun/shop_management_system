@if (count($products) < 1)
<span class="index-error">No data found!!</span>
@else
<table class="table table-dark table-bordered table-hover">
    <thead>
        <th>Image</th>
        <th>Category</th>
        <th>Name</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr class="clickable" data-href="{{ route('products.show',$product->id) }}">
            <td><img src="{{ (empty($product->picture))?asset('images/temp_product_img.png'):asset('images/'.$product->picture) }}" alt=""></td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ ucwords($product->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
