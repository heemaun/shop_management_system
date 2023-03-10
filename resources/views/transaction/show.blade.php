<div id="transactions_show" class="transactions-show">
    <div class="top">
        <h2>Transaction Details</h2>
        <div class="btn-container">
            <a href="{{ route('transactions.index') }}" id="transactions_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('transactions.edit',$transaction->id) }}" id="transactions_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="transactions_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>

    <div class="details">
        <label for="" class="form-label"><span>ID: </span>{{ '#'.$transaction->id }}</label>
        <label for="" class="form-label"><span>Shop Name: </span>{{ $transaction->shop->shop_name }}</label>
        <label for="" class="form-label"><span>From: </span>{{ (strcmp($transaction->from_select,'user')==0) ? $transaction->fromUser->name : $transaction->fromAccount->name }}</label>
        <label for="" class="form-label"><span>To: </span>{{ (strcmp($transaction->to_select,'user')==0) ? $transaction->toUser->name : $transaction->toAccount->name }}</label>
        @if ($transaction->sell_id != null)
        <label for="" class="form-label"><span> Sell ID: </span>{{ '#'.$transaction->sell_id }}</label>
        @endif
        @if ($transaction->purchase_id != null)
        <label for="" class="form-label"><span>Purchase ID: </span>{{ '#'.$transaction->purchase_id }}</label>
        @endif
        <label for="" class="form-label"><span>Type: </span>{{ ucwords($transaction->type) }}</label>
        <label for="" class="form-label"><span>Status: </span>{{ ucwords($transaction->status) }}</label>
        <label for="" class="form-label"><span>Amount: </span>{{ $transaction->amount.' Tk' }}</label>
        <label for="" class="form-label"><span>Last Modified By: </span>{{ $transaction->user->name }}</label>
        <label for="" class="form-label"><span>Created At: </span>{{ $transaction->created_at->diffForHumans() }}</label>
        <label for="" class="form-label"><span>Amount: </span>{{ $transaction->updated_at->diffForHumans() }}</label>
    </div>
</div>

<div id="transactions_delete" class="transactions-delete hide">
    <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST" id="transactions_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="transactions_delete_password" placeholder="enter your password" class="form-control">
        <span class="transactions-delete-error" id="transactions_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="transactions_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>
