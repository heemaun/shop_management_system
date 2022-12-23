<div id="accounts_show" class="accounts-show">
    <div class="top">
        <h2>Account Details</h2>
        <div class="btn-container">
            <a href="{{ route('accounts.index') }}" id="accounts_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('accounts.edit',$account->id) }}" id="accounts_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="accounts_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>
    <div class="details">
        <label for="" class="form-label"><span>Name: </span>{{ $account->name }}</label>
        <label for="" class="form-label"><span>Initial Balance: </span>{{ $account->initial_balance }}</label>
        <label for="" class="form-label"><span>Balance: </span>{{ $account->balance }}</label>
        <label for="" class="form-label"><span>Shop Name: </span>{{ $account->shop->shop_name }}</label>
        <label for="" class="form-label"><span>Last Modified by: </span>{{ $account->user->name }}</label>
        <label for="" class="form-label"><span>Created at: </span>{{ $account->created_at->diffForHumans() }}</label>
        <label for="" class="form-label"><span>Updated at: </span>{{ $account->updated_at->diffForHumans() }}</label>
    </div>
</div>

<div id="accounts_delete" class="accounts-delete hide">
    <form action="{{ route('accounts.destroy',$account->id) }}" method="POST" id="accounts_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="accounts_delete_password" placeholder="enter your password" class="form-control">
        <span class="accounts-delete-error" id="accounts_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="accounts_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>
