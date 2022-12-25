<div id="products_show" class="products-show">
    <div class="top">
        <h2>Product Details</h2>
        <div class="btn-container">
            <a href="{{ route('products.index') }}" id="products_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('products.edit',$product->id) }}" id="products_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="products_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>
    <div class="details">
        <div class="columns">
            <img src="{{ (empty($product->picture))?asset('images/temp_product_img.png'):asset('images/'.$product->picture) }}" alt="product image">
            <button id="products_show_change_image" class="btn btn-outline-primary hide">Change Image</button>
            <form action="{{ route('products.change-image',$product->id) }}" method="POST" id="show_product_change_image_form" enctype="multipart/form-data">
                @csrf
                <input type="file" name="picture" id="products_show_change_image_file" accept="image/*" hidden>
                <button type="submit" class="btn btn-primary">Save Image</button>
            </form>
        </div>

        <div class="columns">
            <label for="" class="form-label"><span>Name: </span>{{ $product->name }}</label>
            <label for="" class="form-label"><span>Status: </span>{{ ucwords($product->status) }}</label>
            <label for="" class="form-label"><span>Initial Inventory: </span>{{ ucwords($product->initial_inventory) }}</label>
            <label for="" class="form-label"><span>Current Inventory: </span>{{ ucwords($product->current_inventory) }}</label>
            <label for="" class="form-label"><span>Purchase Price: </span>{{ ucwords($product->purchase_price) }}</label>
            <label for="" class="form-label"><span>Average Purchase Price: </span>{{ ucwords($product->avg_purchase_price) }}</label>
            <label for="" class="form-label"><span>Selling Price: </span>{{ ucwords($product->selling_price) }}</label>
            <label for="" class="form-label"><span>Shop Name: </span>{{ $product->shop->shop_name }}</label>
            <label for="" class="form-label"><span>Last Modified by: </span>{{ $product->user->name }}</label>
            <label for="" class="form-label"><span>Created at: </span>{{ $product->created_at->diffForHumans() }}</label>
            <label for="" class="form-label"><span>Updated at: </span>{{ $product->updated_at->diffForHumans() }}</label>
        </div>
    </div>
</div>

<div id="products_delete" class="products-delete hide">
    <form action="{{ route('products.destroy',$product->id) }}" method="POST" id="products_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="products_delete_password" placeholder="enter your password" class="form-control">
        <span class="products-delete-error" id="products_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="products_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>

<div id="product_show_image_viewer" class="product-show-image-viewer hide">
    <img src="" alt="">
    <span id="product_show_image_viewer_close"><i class="fa-solid fa-x"></i></span>
</div>
