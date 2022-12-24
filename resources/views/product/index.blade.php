<div id="products_index" class="products-index">
    <div class="top">
        <div class="columns">
            <input type="text" name="search" id="products_index_search" class="form-control" placeholder="seach products name" onkeyup="productsIndexTableLoader()">
        </div>

        <div class="columns">
            <select name="status" id="products_index_status" class="form-select" onchange="productsIndexTableLoader()">
                <option value="all" selected>Select a status</option>
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="banned">Banned</option>
                <option value="deleted">Deleted</option>
                <option value="restricted">Restricted</option>
            </select>

            <select name="category_id" id="products_index_category_id" class="form-select" onchange="productsIndexTableLoader()">
                <option value="all" selected>Select a category</option>
                <option value="all">All</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <a href="{{ route('products.create') }}" id="products_index_create" class="btn btn-success">Create</a>
        </div>
    </div>
    <div id="products_index_table_container" class="table-container">
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
    </div>
</div>
