<div id="categories_show" class="categories-show">
    <div class="top">
        <h2>Category Details</h2>
        <div class="btn-container">
            <a href="{{ route('categories.index') }}" id="categories_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('categories.edit',$category->id) }}" id="categories_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="categories_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>
    <div class="details">
        <label for="" class="form-label"><span>Name: </span>{{ $category->name }}</label>
        <label for="" class="form-label"><span>Status: </span>{{ ucwords($category->status) }}</label>
        <label for="" class="form-label"><span>Shop Name: </span>{{ $category->shop->shop_name }}</label>
        <label for="" class="form-label"><span>Last Modified by: </span>{{ $category->user->name }}</label>
        <label for="" class="form-label"><span>Created at: </span>{{ $category->created_at->diffForHumans() }}</label>
        <label for="" class="form-label"><span>Updated at: </span>{{ $category->updated_at->diffForHumans() }}</label>
    </div>
</div>

<div id="categories_delete" class="categories-delete hide">
    <form action="{{ route('categories.destroy',$category->id) }}" method="POST" id="categories_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="categories_delete_password" placeholder="enter your password" class="form-control">
        <span class="categories-delete-error" id="categories_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="categories_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>
