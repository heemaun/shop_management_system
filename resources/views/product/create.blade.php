<div id="products_create" class="products-create">
    <form action="{{ route('products.store') }}" method="POST" id="products_create_form" enctype="multipart/form-data">
        @csrf

        <legend>Create New Product</legend>

        <div class="rows">
            <div class="columns">
                <label for="products_create_picture">Select a picture</label>
                <img src="{{ asset('images/temp_product_img.png') }}" alt="" id="products_create_tmp_img">
                <input type="file" accept="image/*" name="picture" id="products_create_picture" placeholder="select a picture" class="form-control" hidden>
                <span class="products-create-error" id="products_create_picture_error"></span>
            </div>

            <div class="columns">
                <label for="products_create_name" class="form-label">Name</label>
                <input type="text" name="name" id="products_create_name" placeholder="enter product name" class="form-control">
                <span class="products-create-error" id="products_create_name_error"></span>

                <label for="products_create_initial_inventory" class="form-label">Initial Inventory</label>
                <input type="number" name="initial_inventory" id="products_create_initial_inventory" placeholder="enter product initial inventory" class="form-control">
                <span class="products-create-error" id="products_create_initial_inventory_error"></span>

                <label for="products_create_purchase_price" class="form-label">Purchase Price</label>
                <input type="number" name="purchase_price" id="products_create_purchase_price" placeholder="enter product purchase price" class="form-control">
                <span class="products-create-error" id="products_create_purchase_price_error"></span>
            </div>

            <div class="columns">
                <label for="products_create_selling_price" class="form-label">Selling Price</label>
                <input type="number" name="selling_price" id="products_create_selling_price" placeholder="enter product selling price" class="form-control">
                <span class="products-create-error" id="products_create_selling_price_error"></span>

                <label for="products_create_category_id" class="form-label">Select a category</label>
                <select name="category_id" id="products_create_category_id" class="form-select">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="products-create-error" id="products_create_category_id_error"></span>

                <label for="products_create_status" class="form-label">Status</label>
                <select name="status" id="products_create_status" class="form-select">
                    <option value="">Select a status</option>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="banned">Banned</option>
                    <option value="deleted">Deleted</option>
                    <option value="restricted">Restricted</option>
                </select>
                <span class="products-create-error" id="products_create_status_error"></span>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('products.index') }}" id="products_create_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
