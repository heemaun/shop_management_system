<div id="transactions_edit" class="transactions-edit">
    <form action="{{ route('transactions.update',$transaction->id) }}" method="POST" id="transactions_edit_form" >
        @csrf
        @method("PUT")

        <legend>Edit New Transaction</legend>

        <div class="rows">
            <div class="form-group">
                <label for="transactions_edit_from_type" class="form-label">Select From Type</label>
                <select name="from_select" id="transactions_edit_from_select" class="form-select" onchange="searchEditFromTrigger()">
                    <option value="">Choose a option</option>
                    <option value="user" {{ (strcmp('user',$transaction->from_select)==0) ? 'selected' : '' }}>User</option>
                    <option value="account" {{ (strcmp('account',$transaction->from_select)==0) ? 'selected' : '' }}>Account</option>
                </select>
                <span class="transactions-edit-error" id="transactions_edit_from_select_error"></span>
            </div>

            <div class="form-group">
                <label for="transactions_edit_from_text" class="form-label">From</label>
                <input type="text" id="transactions_edit_from_text" name="from" placeholder="enter name" class="form-control" onkeyup="searchEditFromText()" value="{{ (strcmp('user',$transaction->from_select)==0) ? $transaction->fromUser->name : $transaction->fromAccount->name }}">
                <ul id="transactions_edit_from_ul">

                </ul>
                <input type="text" id="transactions_edit_from_id" name="from_id" class="form-control" hidden value="{{ (strcmp('user',$transaction->from_select)==0) ? $transaction->from_user : $transaction->from_account }}">
                <span class="transactions-edit-error" id="transactions_edit_from_id_error"></span>
            </div>

            <div class="form-group">
                <label for="transactions_edit_to_type" class="form-label">Select To Type</label>
                <select name="to_select" id="transactions_edit_to_select" class="form-select" onchange="searchEditToTrigger()">
                    <option value="">Choose a option</option>
                    <option value="user" {{ (strcmp('user',$transaction->to_select)==0) ? 'selected' : '' }}>User</option>
                    <option value="account" {{ (strcmp('account',$transaction->to_select)==0) ? 'selected' : '' }}>Account</option>
                </select>
                <span class="transactions-edit-error" id="transactions_edit_to_select_error"></span>
            </div>

            <div class="form-group">
                <label for="transactions_edit_to_text" class="form-label">To</label>
                <input type="text" id="transactions_edit_to_text" name="to" placeholder="enter name" class="form-control" onkeyup="searchEditToText()" value="{{ (strcmp('user',$transaction->to_select)==0) ? $transaction->toUser->name : $transaction->toAccount->name }}">
                <ul id="transactions_edit_to_ul">

                </ul>
                <input type="text" id="transactions_edit_to_id" name="to_id" class="form-control" hidden value="{{ (strcmp('user',$transaction->to_select)==0) ? $transaction->to_user : $transaction->to_account }}">
                <span class="transactions-edit-error" id="transactions_edit_to_id_error"></span>
            </div>
        </div>

        <div class="rows">
            <div class="form-group">
                <label for="transactions_edit_type" class="form-label">Select to type</label>
                <select name="type" id="transactions_edit_type" class="form-select">
                    <option value="" selected>Select a type</option>
                    <option value="sell" {{ (strcmp('sell',$transaction->type)==0) ? 'selected' : '' }}>Sell</option>
                    <option value="purchase" {{ (strcmp('purchase',$transaction->type)==0) ? 'selected' : '' }}>Purchase</option>
                    <option value="salary" {{ (strcmp('salary',$transaction->type)==0) ? 'selected' : '' }}>Salary</option>
                    <option value="deposite" {{ (strcmp('deposite',$transaction->type)==0) ? 'selected' : '' }}>Deposite</option>
                    <option value="withdraw" {{ (strcmp('withdraw',$transaction->type)==0) ? 'selected' : '' }}>Withdraw</option>
                    <option value="transfer" {{ (strcmp('transfer',$transaction->type)==0) ? 'selected' : '' }}>Transfer</option>
                    <option value="other" {{ (strcmp('other',$transaction->type)==0) ? 'selected' : '' }}>Other</option>
                </select>
                <span class="transactions-edit-error" id="transactions_edit_type_error"></span>
            </div>

            <div class="form-group">
                <label for="transactions_edit_status" class="form-label">Select status</label>
                <select name="status" id="transactions_edit_status" class="form-select">
                    <option value="">Select a status</option>
                    <option value="pending" {{ (strcmp('pending',$transaction->status)==0) ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ (strcmp('active',$transaction->status)==0) ? 'selected' : '' }}>Active</option>
                    <option value="banned" {{ (strcmp('banned',$transaction->status)==0) ? 'selected' : '' }}>Banned</option>
                    <option value="deleted" {{ (strcmp('deleted',$transaction->status)==0) ? 'selected' : '' }}>Deleted</option>
                    <option value="restricted" {{ (strcmp('restricted',$transaction->status)==0) ? 'selected' : '' }}>Restricted</option>
                </select>
                <span class="transactions-edit-error" id="transactions_edit_status_error"></span>
            </div>

            <div class="form-group">
                <label for="transactions_edit_amount" class="form-label">Amount</label>
                <input type="number" name="amount" id="transactions_edit_amount" placeholder="enter amount" class="form-control" value="{{ $transaction->amount }}">
                <span class="transactions-edit-error" id="transactions_edit_amount_error"></span>
            </div>
        </div>

        <div class="rows">
            <div class="form-group">
                <label for="transactions_edit_purchase_id">Enter purchase id</label>
                <input type="number" name="amount" id="transactions_edit_purchase_id" placeholder="enter purchase id" class="form-control" value="{{ $transaction->purchase_id }}">
                <span class="transactions-edit-error" id="transactions_edit_purchase_id_error"></span>
            </div>

            <div class="form-group">
                <label for="transactions_edit_sell_id">Enter sell id</label>
                <input type="number" name="amount" id="transactions_edit_sell_id" placeholder="enter sell id" class="form-control" {{ $transaction->sell_id }}>
                <span class="transactions-edit-error" id="transactions_edit_sell_id_error"></span>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('transactions.show',$transaction->id) }}" id="transactions_edit_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
