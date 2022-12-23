<div id="accounts_edit" class="accounts-edit">
    <form action="{{ route('accounts.update',$account->id) }}" method="POST" id="accounts_edit_form">
        @csrf
        @method("PUT")

        <legend>Edit Account</legend>
        <label for="accounts_edit_name" class="form-label">Name</label>
        <input type="text" name="name" id="accounts_edit_name" placeholder="enter account name" class="form-control" value="{{ $account->name }}">
        <span class="accounts-edit-error" id="accounts_edit_name_error"></span>

        <label for="accounts_edit_initial_balance" class="form-label">Initial Balance</label>
        <input type="number" name="initial_balance" id="accounts_edit_initial_balance" placeholder="enter account initial balance" class="form-control" value="{{ $account->initial_balance }}">
        <span class="accounts-edit-error" id="accounts_edit_initial_balance_error"></span>

        <label for="accounts_edit_balance" class="form-label">Balance</label>
        <input type="number" name="balance" id="accounts_edit_balance" placeholder="enter account balance" class="form-control" value="{{ $account->balance }}">
        <span class="accounts-edit-error" id="accounts_edit_balance_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('accounts.show',$account->id) }}" id="accounts_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
