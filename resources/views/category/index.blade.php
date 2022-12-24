<div id="categories_index" class="categories-index">
    <div class="top">
        <div class="columns">
            <input type="text" name="search" id="categories_index_search" class="form-control" placeholder="seach categories name" onkeyup="categoriesIndexTableLoader()">
        </div>

        <div class="columns">
            <select name="status" id="categories_index_status" class="form-select" onchange="categoriesIndexTableLoader()">
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="banned">Banned</option>
                <option value="deleted">Deleted</option>
                <option value="restricted">Restricted</option>
            </select>

            <a href="{{ route('categories.create') }}" id="categories_index_create" class="btn btn-success">Create</a>
        </div>
    </div>
    <div id="categories_index_table_container" class="table-container">
        <table class="table table-dark table-bordered">
            <thead>
                <th>Name</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="clickable" data-href="{{ route('categories.show',$category->id) }}">
                    <td>{{ $category->name }}</td>
                    <td>{{ ucwords($category->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
