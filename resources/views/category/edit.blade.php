<div id="categories_edit" class="categories-edit">
    <form action="{{ route('categories.update',$category->id) }}" method="POST" id="categories_edit_form">
        @csrf
        @method("PUT")

        <legend>Edit Category</legend>
        <label for="categories_edit_name" class="form-label">Name</label>
        <input type="text" name="name" id="categories_edit_name" placeholder="enter category name" class="form-control" value="{{ $category->name }}">
        <span class="categories-edit-error" id="categories_edit_name_error"></span>

        <label for="categories_edit_status" class="form-label">Status</label>
        <select name="status" id="categories_edit_status" class="form-select">
            <option value="">Select a value</option>
            <option value="pending" {{ (strcmp('pending',$category->status)==0)?'selected':'' }}>Pending</option>
            <option value="active" {{ (strcmp('active',$category->status)==0)?'selected':'' }}>Active</option>
            <option value="banned" {{ (strcmp('banned',$category->status)==0)?'selected':'' }}>Banned</option>
            <option value="deleted" {{ (strcmp('deleted',$category->status)==0)?'selected':'' }}>Deleted</option>
            <option value="restricted" {{ (strcmp('restricted',$category->status)==0)?'selected':'' }}>Restricted</option>
        </select>
        <span class="categories-edit-error" id="categories_edit_status_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.show',$category->id) }}" id="categories_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
