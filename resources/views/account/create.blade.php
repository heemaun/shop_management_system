<div id="accounts_create" class="accounts-create">
    <form action="{{ route('accounts.store') }}" method="POST" id="accounts_create_form">
        @csrf
        
        <legend>Create New Account</legend>
        <label for="accounts_create_name" class="form-label">Name</label>
        <input type="text" name="name" id="accounts_create_name" placeholder="enter account name" class="form-control">
        <span class="accounts-create-error" id="accounts_create_name_error"></span>

        <label for="accounts_create_initial_balance" class="form-label">Initial Balance</label>
        <input type="number" name="initial_balance" id="accounts_create_initial_balance" placeholder="enter account initial balance" class="form-control">
        <span class="accounts-create-error" id="accounts_create_initial_balance_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('accounts.index') }}" id="accounts_create_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
