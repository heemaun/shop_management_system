<div id="products_edit" class="products-edit">
    <form action="{{ route('products.update',$product->id) }}" method="POST" id="products_edit_form">
        @csrf
        @method("PUT")

        <legend>Edit Product</legend>

        <div class="rows">
            <div class="columns">
                <label for="products_edit_name" class="form-label">Name</label>
                <input type="text" name="name" id="products_edit_name" placeholder="enter product name" class="form-control" value="{{ $product->name }}">
                <span class="products-edit-error" id="products_edit_name_error"></span>

                <label for="products_edit_initial_inventory" class="form-label">Initial Inventory</label>
                <input type="number" name="initial_inventory" id="products_edit_initial_inventory" placeholder="enter product initial inventory" class="form-control" value="{{ $product->initial_inventory }}">
                <span class="products-edit-error" id="products_edit_initial_inventory_error"></span>

                <label for="products_edit_current_inventory" class="form-label">Current Inventory</label>
                <input type="number" name="current_inventory" id="products_edit_current_inventory" placeholder="enter product current inventory" class="form-control" value="{{ $product->current_inventory }}">
                <span class="products-edit-error" id="products_edit_current_inventory_error"></span>

                <label for="products_edit_purchase_price" class="form-label">Purchase Price</label>
                <input type="number" name="purchase_price" id="products_edit_purchase_price" placeholder="enter product purchase price" class="form-control" value="{{ $product->purchase_price }}">
                <span class="products-edit-error" id="products_edit_purchase_price_error"></span>
            </div>

            <div class="columns">
                <label for="products_edit_avg_purchase_price" class="form-label">Average Purchase Price</label>
                <input type="number" name="avg_purchase_price" id="products_edit_avg_purchase_price" placeholder="enter product average purchase price" class="form-control" value="{{ $product->avg_purchase_price }}">
                <span class="products-edit-error" id="products_edit_avg_purchase_price_error"></span>

                <label for="products_edit_selling_price" class="form-label">Selling Price</label>
                <input type="number" name="selling_price" id="products_edit_selling_price" placeholder="enter product selling price" class="form-control" value="{{ $product->selling_price }}">
                <span class="products-edit-error" id="products_edit_selling_price_error"></span>

                <label for="products_edit_category_id" class="form-label">Select a category</label>
                <select name="category_id" id="products_edit_category_id" class="form-select">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ ($product->category_id == $category->id)?"selected":"" }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="products-edit-error" id="products_edit_category_id_error"></span>

                <label for="products_edit_status" class="form-label">Status</label>
                <select name="status" id="products_edit_status" class="form-select">
                    <option value="">Select a status</option>
                    <option value="pending" {{ (strcmp('pending',$product->status)==0)?"selected":"" }}>Pending</option>
                    <option value="active" {{ (strcmp('active',$product->status)==0)?"selected":"" }}>Active</option>
                    <option value="banned" {{ (strcmp('banned',$product->status)==0)?"selected":"" }}>Banned</option>
                    <option value="deleted" {{ (strcmp('deleted',$product->status)==0)?"selected":"" }}>Deleted</option>
                    <option value="restricted" {{ (strcmp('restricted',$product->status)==0)?"selected":"" }}>Restricted</option>
                </select>
                <span class="products-edit-error" id="products_edit_status_error"></span>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.show',$product->id) }}" id="products_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
