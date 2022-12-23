<div id="categories_create" class="categories-create">
    <form action="{{ route('categories.store') }}" method="POST" id="categories_create_form">
        @csrf

        <legend>Create New Category</legend>
        <label for="categories_create_name" class="form-label">Name</label>
        <input type="text" name="name" id="categories_create_name" placeholder="enter category name" class="form-control">
        <span class="categories-create-error" id="categories_create_name_error"></span>

        <label for="categories_create_status" class="form-label">Status</label>
        <select name="status" id="categories_create_status" class="form-select">
            <option value="">Select a value</option>
            <option value="pending">Pending</option>
            <option value="active">Active</option>
            <option value="banned">Banned</option>
            <option value="deleted">Deleted</option>
            <option value="restricted">Restricted</option>
        </select>
        <span class="categories-create-error" id="categories_create_status_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('categories.index') }}" id="categories_create_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
