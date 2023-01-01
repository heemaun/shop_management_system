<div id="shops_create" class="shops-create">
    <form action="{{ route('shops.store') }}" method="POST" id="shops_create_form">
        @csrf

        <legend>Create New Shop</legend>
        <label for="shops_create_name" class="form-label">Name</label>
        <input type="text" name="name" id="shops_create_name" placeholder="enter shop name" class="form-control">
        <span class="shops-create-error" id="shops_create_shop_name_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('shops.index') }}" id="shops_create_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
