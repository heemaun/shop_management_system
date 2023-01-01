<div id="users_index" class="users-index">
    <div class="top">
        <div class="columns">
            <input type="text" name="search" id="users_index_search" class="form-control" placeholder="seach users name" onkeyup="usersIndexTableLoader()">
        </div>

        <div class="columns">
            <select name="status" id="users_index_status" class="form-select" onchange="usersIndexTableLoader()">
                <option value="all" selected>Select a status</option>
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="banned">Banned</option>
                <option value="deleted">Deleted</option>
                <option value="restricted">Restricted</option>
            </select>

            <select name="role" id="users_index_role" class="form-select" onchange="usersIndexTableLoader()">
                <option value="all" selected>Select a role</option>
                <option value="all">All</option>
                <option value="super_admin">Super Admin</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="seller">Seller</option>
                <option value="customer">Customer</option>
            </select>

            <a href="{{ route('users.create') }}" id="users_index_create" class="btn btn-success">Create</a>
        </div>
    </div>

    <div id="users_index_table_container" class="table-container">
        <table class="table table-dark table-bordered">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Role</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="clickable" data-href="{{ route('users.show',$user->id) }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ ucwords($user->status) }}</td>
                    <td>{{ ucwords($user->role) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
