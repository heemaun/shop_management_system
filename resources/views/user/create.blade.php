<div id="users_create" class="users-create">
    <form action="{{ route('users.store') }}" method="POST" id="users_create_form" enctype="multipart/form-data">
        @csrf

        <legend>Create New User</legend>

        <div class="rows">
            <div class="columns">
                <label for="users_create_picture" class="form-label">Picture</label>
                <input type="file" name="picture" id="users_create_picture" accept="image/*" placeholder="enter user picture" class="form-control" hidden>
                <img src="{{ asset('images/default_user_picture_other.png') }}" alt="User default picture" id="users_create_tmp_img">
                <span class="users-create-error" id="users_create_picture_error"></span>
            </div>

            <div class="columns">
                <label for="users_create_name" class="form-label">Name</label>
                <input type="text" name="name" id="users_create_name" placeholder="enter user name" class="form-control">
                <span class="users-create-error" id="users_create_name_error"></span>

                <label for="users_create_email" class="form-label">Email</label>
                <input type="text" name="email" id="users_create_email" placeholder="enter user email" class="form-control">
                <span class="users-create-error" id="users_create_email_error"></span>

                <label for="users_create_phone" class="form-label">Phone</label>
                <input type="number" name="phone" id="users_create_phone" placeholder="enter user phone" class="form-control">
                <span class="users-create-error" id="users_create_phone_error"></span>

                <label for="users_create_user_name" class="form-label">User Name</label>
                <input type="text" name="user_name" id="users_create_user_name" placeholder="enter user user name" class="form-control">
                <span class="users-create-error" id="users_create_user_name_error"></span>
            </div>

            <div class="columns">
                <label for="users_create_date_of_birth" class="form-label">Date of birth</label>
                <input type="date" name="date_of_birth" id="users_create_date_of_birth" placeholder="enter user date of birth" class="form-control">
                <span class="users-create-error" id="users_create_date_of_birth_error"></span>

                <label for="users_create_gender" class="form-label">Gender</label>
                <select name="gender" id="user_create_gender" class="form-select">
                    <option value="">select a gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <span class="users-create-error" id="users_create_gender_error"></span>

                <label for="users_create_address" class="form-label">Address</label>
                <textarea name="address" id="users_create_address" placeholder="enter user address" class="form-control"></textarea>
                <span class="users-create-error" id="users_create_address_error"></span>
            </div>

            <div class="columns">
                <label for="users_create_salary" class="form-label">Salary</label>
                <input type="number" name="salary" id="users_create_salary" placeholder="enter user salary" class="form-control">
                <span class="users-create-error" id="users_create_salary_error"></span>

                <label for="users_create_status" class="form-label">Status</label>
                <select name="status" id="user_create_status" class="form-select">
                    <option value="">select a status</option>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="deleted">Deleted</option>
                    <option value="banned">Banned</option>
                    <option value="restricted">Restricted</option>
                </select>
                <span class="users-create-error" id="users_create_status_error"></span>

                <label for="users_create_role" class="form-label">Role</label>
                <select name="role" id="user_create_role" class="form-select">
                    <option value="">select a role</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="seller">Seller</option>
                    <option value="customer">Customer</option>
                </select>
                <span class="users-create-error" id="users_create_role_error"></span>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('users.index') }}" id="users_create_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
