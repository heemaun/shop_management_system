<div id="transactions_edit" class="transactions-edit">
    <form action="{{ route('transactions.update',$transaction->id) }}" method="POST" id="transactions_edit_form">
        @csrf
        @method("PUT")

        <legend>Edit New Transaction</legend>

        <div class="rows">

            <div class="columns">
                <label for="transactions_edit_name" class="form-label">Name</label>
                <input type="text" name="name" id="transactions_edit_name" placeholder="enter transaction name" class="form-control" value="{{ $transaction->name }}">
                <span class="transactions-edit-error" id="transactions_edit_name_error"></span>

                <label for="transactions_edit_email" class="form-label">Email</label>
                <input type="text" name="email" id="transactions_edit_email" placeholder="enter transaction email" class="form-control" value="{{ $transaction->email }}">
                <span class="transactions-edit-error" id="transactions_edit_email_error"></span>

                <label for="transactions_edit_phone" class="form-label">Phone</label>
                <input type="number" name="phone" id="transactions_edit_phone" placeholder="enter transaction phone" class="form-control" value="{{ $transaction->phone }}">
                <span class="transactions-edit-error" id="transactions_edit_phone_error"></span>

                <label for="transactions_edit_transaction_name" class="form-label">Transaction Name</label>
                <input type="text" name="transaction_name" id="transactions_edit_transaction_name" placeholder="enter transaction transaction name" class="form-control" value="{{ $transaction->transaction_name }}">
                <span class="transactions-edit-error" id="transactions_edit_transaction_name_error"></span>
            </div>

            <div class="columns">
                <label for="transactions_edit_date_of_birth" class="form-label">Date of birth</label>
                <input type="date" name="date_of_birth" id="transactions_edit_date_of_birth" placeholder="enter transaction date of birth" class="form-control" value="{{ $transaction->date_of_birth }}">
                <span class="transactions-edit-error" id="transactions_edit_date_of_birth_error"></span>

                <label for="transactions_edit_gender" class="form-label">Gender</label>
                <select name="gender" id="transactions_edit_gender" class="form-select">
                    <option value="">select a gender</option>
                    <option value="male" {{ (strcmp('male',$transaction->gender)==0) ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ (strcmp('female',$transaction->gender)==0) ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ (strcmp('other',$transaction->gender)==0) ? 'selected' : '' }}>Other</option>
                </select>
                <span class="transactions-edit-error" id="transactions_edit_gender_error"></span>

                <label for="transactions_edit_address" class="form-label">Address</label>
                <textarea name="address" id="transactions_edit_address" placeholder="enter transaction address" class="form-control">{{ $transaction->address }}</textarea>
                <span class="transactions-edit-error" id="transactions_edit_address_error"></span>
            </div>

            <div class="columns">
                <label for="transactions_edit_salary" class="form-label">Salary</label>
                <input type="number" name="salary" id="transactions_edit_salary" placeholder="enter transaction salary" class="form-control" value="{{ $transaction->salary }}">
                <span class="transactions-edit-error" id="transactions_edit_salary_error"></span>

                <label for="transactions_edit_status" class="form-label">Status</label>
                <select name="status" id="transactions_edit_status" class="form-select">
                    <option value="">select a status</option>
                    <option value="pending" {{ (strcmp('pending',$transaction->status)==0) ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ (strcmp('active',$transaction->status)==0) ? 'selected' : '' }}>Active</option>
                    <option value="deleted" {{ (strcmp('deleted',$transaction->status)==0) ? 'selected' : '' }}>Deleted</option>
                    <option value="banned" {{ (strcmp('banned',$transaction->status)==0) ? 'selected' : '' }}>Banned</option>
                    <option value="restricted" {{ (strcmp('restricted',$transaction->status)==0) ? 'selected' : '' }}>Restricted</option>
                </select>
                <span class="transactions-edit-error" id="transactions_edit_status_error"></span>

                <label for="transactions_edit_role" class="form-label">Role</label>
                <select name="role" id="transactions_edit_role" class="form-select">
                    <option value="">select a role</option>
                    <option value="admin" {{ (strcmp('admin',$transaction->role)==0) ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ (strcmp('manager',$transaction->role)==0) ? 'selected' : '' }}>Manager</option>
                    <option value="seller" {{ (strcmp('seller',$transaction->role)==0) ? 'selected' : '' }}>Seller</option>
                    <option value="customer" {{ (strcmp('customer',$transaction->role)==0) ? 'selected' : '' }}>Customer</option>
                </select>
                <span class="transactions-edit-error" id="transactions_edit_role_error"></span>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('transactions.show',$transaction->id) }}" id="transactions_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
