<div id="users_edit" class="users-edit">
    <form action="{{ route('users.update',$user->id) }}" method="POST" id="users_edit_form">
        @csrf
        @method("PUT")

        <legend>Edit New User</legend>

        <div class="rows">

            <div class="columns">
                <label for="users_edit_name" class="form-label">Name</label>
                <input type="text" name="name" id="users_edit_name" placeholder="enter user name" class="form-control" value="{{ $user->name }}">
                <span class="users-edit-error" id="users_edit_name_error"></span>

                <label for="users_edit_email" class="form-label">Email</label>
                <input type="text" name="email" id="users_edit_email" placeholder="enter user email" class="form-control" value="{{ $user->email }}">
                <span class="users-edit-error" id="users_edit_email_error"></span>

                <label for="users_edit_phone" class="form-label">Phone</label>
                <input type="number" name="phone" id="users_edit_phone" placeholder="enter user phone" class="form-control" value="{{ $user->phone }}">
                <span class="users-edit-error" id="users_edit_phone_error"></span>

                <label for="users_edit_user_name" class="form-label">User Name</label>
                <input type="text" name="user_name" id="users_edit_user_name" placeholder="enter user user name" class="form-control" value="{{ $user->user_name }}">
                <span class="users-edit-error" id="users_edit_user_name_error"></span>
            </div>

            <div class="columns">
                <label for="users_edit_date_of_birth" class="form-label">Date of birth</label>
                <input type="date" name="date_of_birth" id="users_edit_date_of_birth" placeholder="enter user date of birth" class="form-control" value="{{ $user->date_of_birth }}">
                <span class="users-edit-error" id="users_edit_date_of_birth_error"></span>

                <label for="users_edit_gender" class="form-label">Gender</label>
                <select name="gender" id="users_edit_gender" class="form-select">
                    <option value="">select a gender</option>
                    <option value="male" {{ (strcmp('male',$user->gender)==0) ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ (strcmp('female',$user->gender)==0) ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ (strcmp('other',$user->gender)==0) ? 'selected' : '' }}>Other</option>
                </select>
                <span class="users-edit-error" id="users_edit_gender_error"></span>

                <label for="users_edit_address" class="form-label">Address</label>
                <textarea name="address" id="users_edit_address" placeholder="enter user address" class="form-control">{{ $user->address }}</textarea>
                <span class="users-edit-error" id="users_edit_address_error"></span>
            </div>

            <div class="columns">
                <label for="users_edit_salary" class="form-label">Salary</label>
                <input type="number" name="salary" id="users_edit_salary" placeholder="enter user salary" class="form-control" value="{{ $user->salary }}">
                <span class="users-edit-error" id="users_edit_salary_error"></span>

                <label for="users_edit_status" class="form-label">Status</label>
                <select name="status" id="users_edit_status" class="form-select">
                    <option value="">select a status</option>
                    <option value="pending" {{ (strcmp('pending',$user->status)==0) ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ (strcmp('active',$user->status)==0) ? 'selected' : '' }}>Active</option>
                    <option value="deleted" {{ (strcmp('deleted',$user->status)==0) ? 'selected' : '' }}>Deleted</option>
                    <option value="banned" {{ (strcmp('banned',$user->status)==0) ? 'selected' : '' }}>Banned</option>
                    <option value="restricted" {{ (strcmp('restricted',$user->status)==0) ? 'selected' : '' }}>Restricted</option>
                </select>
                <span class="users-edit-error" id="users_edit_status_error"></span>

                <label for="users_edit_role" class="form-label">Role</label>
                <select name="role" id="users_edit_role" class="form-select">
                    <option value="">select a role</option>
                    <option value="admin" {{ (strcmp('admin',$user->role)==0) ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ (strcmp('manager',$user->role)==0) ? 'selected' : '' }}>Manager</option>
                    <option value="seller" {{ (strcmp('seller',$user->role)==0) ? 'selected' : '' }}>Seller</option>
                    <option value="customer" {{ (strcmp('customer',$user->role)==0) ? 'selected' : '' }}>Customer</option>
                </select>
                <span class="users-edit-error" id="users_edit_role_error"></span>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.show',$user->id) }}" id="users_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
