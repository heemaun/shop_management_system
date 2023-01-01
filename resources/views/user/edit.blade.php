<div id="users_edit" class="users-edit">
    <form action="{{ route('users.update',$user->id) }}" method="POST" id="users_edit_form">
        @csrf
        @method("PUT")

        <legend>Edit User</legend>
        <label for="users_edit_name" class="form-label">Name</label>
        <input type="text" name="name" id="users_edit_name" placeholder="enter user name" class="form-control" value="{{ $user->name }}">
        <span class="users-edit-error" id="users_edit_name_error"></span>

        <label for="users_edit_initial_balance" class="form-label">Initial Balance</label>
        <input type="number" name="initial_balance" id="users_edit_initial_balance" placeholder="enter user initial balance" class="form-control" value="{{ $user->initial_balance }}">
        <span class="users-edit-error" id="users_edit_initial_balance_error"></span>

        <label for="users_edit_balance" class="form-label">Balance</label>
        <input type="number" name="balance" id="users_edit_balance" placeholder="enter user balance" class="form-control" value="{{ $user->balance }}">
        <span class="users-edit-error" id="users_edit_balance_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.show',$user->id) }}" id="users_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
