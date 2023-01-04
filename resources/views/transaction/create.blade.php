<div id="transactions_create" class="transactions-create">
    <form action="{{ route('transactions.store') }}" method="POST" id="transactions_create_form" enctype="multipart/form-data">
        @csrf

        <legend>Create New Transaction</legend>

        <div class="rows">
            <div class="columns">
                <label for="transactions_create_picture" class="form-label">Picture</label>
                <input type="file" name="picture" id="transactions_create_picture" accept="image/*" placeholder="enter transaction picture" class="form-control" hidden>
                <img src="{{ asset('images/default_transaction_picture_other.png') }}" alt="Transaction default picture" id="transactions_create_tmp_img">
                <span class="transactions-create-error" id="transactions_create_picture_error"></span>
            </div>

            <div class="columns">
                <label for="transactions_create_name" class="form-label">Name</label>
                <input type="text" name="name" id="transactions_create_name" placeholder="enter transaction name" class="form-control">
                <span class="transactions-create-error" id="transactions_create_name_error"></span>

                <label for="transactions_create_email" class="form-label">Email</label>
                <input type="text" name="email" id="transactions_create_email" placeholder="enter transaction email" class="form-control">
                <span class="transactions-create-error" id="transactions_create_email_error"></span>

                <label for="transactions_create_phone" class="form-label">Phone</label>
                <input type="number" name="phone" id="transactions_create_phone" placeholder="enter transaction phone" class="form-control">
                <span class="transactions-create-error" id="transactions_create_phone_error"></span>

                <label for="transactions_create_transaction_name" class="form-label">Transaction Name</label>
                <input type="text" name="transaction_name" id="transactions_create_transaction_name" placeholder="enter transaction transaction name" class="form-control">
                <span class="transactions-create-error" id="transactions_create_transaction_name_error"></span>
            </div>

            <div class="columns">
                <label for="transactions_create_date_of_birth" class="form-label">Date of birth</label>
                <input type="date" name="date_of_birth" id="transactions_create_date_of_birth" placeholder="enter transaction date of birth" class="form-control">
                <span class="transactions-create-error" id="transactions_create_date_of_birth_error"></span>

                <label for="transactions_create_gender" class="form-label">Gender</label>
                <select name="gender" id="transaction_create_gender" class="form-select">
                    <option value="">select a gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <span class="transactions-create-error" id="transactions_create_gender_error"></span>

                <label for="transactions_create_address" class="form-label">Address</label>
                <textarea name="address" id="transactions_create_address" placeholder="enter transaction address" class="form-control"></textarea>
                <span class="transactions-create-error" id="transactions_create_address_error"></span>
            </div>

            <div class="columns">
                <label for="transactions_create_salary" class="form-label">Salary</label>
                <input type="number" name="salary" id="transactions_create_salary" placeholder="enter transaction salary" class="form-control">
                <span class="transactions-create-error" id="transactions_create_salary_error"></span>

                <label for="transactions_create_status" class="form-label">Status</label>
                <select name="status" id="transaction_create_status" class="form-select">
                    <option value="">select a status</option>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="deleted">Deleted</option>
                    <option value="banned">Banned</option>
                    <option value="restricted">Restricted</option>
                </select>
                <span class="transactions-create-error" id="transactions_create_status_error"></span>

                <label for="transactions_create_role" class="form-label">Role</label>
                <select name="role" id="transaction_create_role" class="form-select">
                    <option value="">select a role</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="seller">Seller</option>
                    <option value="customer">Customer</option>
                </select>
                <span class="transactions-create-error" id="transactions_create_role_error"></span>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('transactions.index') }}" id="transactions_create_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
