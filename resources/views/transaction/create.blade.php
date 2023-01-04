<div id="transactions_create" class="transactions-create">
    <form action="{{ route('transactions.store') }}" method="POST" id="transactions_create_form" >
        @csrf

        <legend>Create New Transaction</legend>

        <div class="form-groups two">
            <div class="rows">
                <label for="transactions_create_from_type" class="form-label">Select Type</label>
                <select name="from_select" id="transactions_create_from_select" class="form-select" onchange="searchFromTrigger()">
                    <option value="">Choose a option</option>
                    <option value="user">User</option>
                    <option value="account">Account</option>
                </select>
                <span class="transactions_create_error" id="transaction_create_from_type_error"></span>
            </div>

            <div class="rows">
                <label for="transactions_create_from_text" class="form-label">From</label>
                <input type="text" id="transactions_create_from_text" name="from" placeholder="enter name" class="form-control" disabled onkeyup="searchFromText()">
                <ul id="transactions_create_from_ul">

                </ul>
                <span class="transactions_create_error" id="transaction_create_from_text_error"></span>
            </div>
        </div>

        <div class="form-groups two">
            <div class="rows">
                <label for="transactions_create_to_type" class="form-label">Select Type</label>
                <select name="to_select" id="transactions_create_to_select" class="form-select" onchange="searchToTrigger()">
                    <option value="">Choose a option</option>
                    <option value="user">User</option>
                    <option value="account">Account</option>
                </select>
                <span class="transactions_create_error" id="transaction_create_to_type_error"></span>
            </div>

            <div class="rows">
                <label for="transactions_create_to_text" class="form-label">To</label>
                <input type="text" id="transactions_create_to_text" name="from" placeholder="enter name" class="form-control" disabled>
                <ul id="transactions_create_to_ul">

                </ul>
                <span class="transactions_create_error" id="transaction_create_to_text_error"></span>
            </div>
        </div>

        <div class="form-groups two">
            <div class="rows">
                <label for="transactions_create_type" class="form-label">Select type</label>
                <select name="type" id="transactions_create_type" class="form-select">
                    <option value="" selected>Select a type</option>
                    <option value="sell">Sell</option>
                    <option value="purchase">Purchase</option>
                    <option value="salary">Salary</option>
                    <option value="deposite">Deposite</option>
                    <option value="withdraw">Withdraw</option>
                    <option value="transfer">Transfer</option>
                    <option value="other">Other</option>
                </select>
                <span class="transactions_create_error" id="transaction_create_type_error"></span>
            </div>

            <div class="rows">
                <label for="transactions_create_status" class="form-label">Select status</label>
                <select name="status" id="transactions_create_status" class="form-select">
                    <option value="" selected>Select a status</option>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="banned">Banned</option>
                    <option value="deleted">Deleted</option>
                    <option value="restricted">Restricted</option>
                </select>
                <span class="transactions_create_error" id="transaction_create_statue_error"></span>
            </div>
        </div>

        <div class="form-groups two">
            <div class="rows">
                <label for="transaction_create_purchase_id">Enter purchase id</label>
                <input type="number" name="amount" id="transaction_create_purchase_id" placeholder="enter purchase id" class="form-control">
                <span class="transactions_create_error" id="transaction_create_purchase_id_error"></span>
            </div>

            <div class="rows">
                <label for="transaction_create_sell_id">Enter sell id</label>
                <input type="number" name="amount" id="transaction_create_sell_id" placeholder="enter sell id" class="form-control">
                <span class="transactions_create_error" id="transaction_create_sell_id_error"></span>
            </div>
        </div>

        <div class="form-groups">
            <label for="transaction_create_amount">Amount</label>
            <input type="number" name="amount" id="transaction_create_amount" placeholder="enter amount" class="form-control">
            <span class="transactions_create_error" id="transaction_create_amount"></span>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('transactions.index') }}" id="transactions_create_close" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
