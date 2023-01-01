<div id="shops_edit" class="shops-edit">
    <form action="{{ route('shops.update',$shop->id) }}" method="POST" id="shops_edit_form">
        @csrf
        @method("PUT")

        <legend>Edit Shop</legend>
        <label for="shops_edit_name" class="form-label">Name</label>
        <input type="text" name="name" id="shops_edit_shop_name" placeholder="enter shop name" class="form-control" value="{{ $shop->shop_name }}">
        <span class="shops-edit-error" id="shops_edit_shop_name_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('shops.show',$shop->id) }}" id="shops_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
