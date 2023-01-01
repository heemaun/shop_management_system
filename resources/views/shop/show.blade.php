<div id="shops_show" class="shops-show">
    <div class="top">
        <h2>Shop Details</h2>
        <div class="btn-container">
            <a href="{{ route('shops.index') }}" id="shops_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('shops.edit',$shop->id) }}" id="shops_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="shops_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>
    <div class="details">
        <label for="" class="form-label"><span>Name: </span>{{ $shop->shop_name }}</label>
    </div>
</div>

<div id="shops_delete" class="shops-delete hide">
    <form action="{{ route('shops.destroy',$shop->id) }}" method="POST" id="shops_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="shops_delete_password" placeholder="enter your password" class="form-control">
        <span class="shops-delete-error" id="shops_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="shops_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>
