<div id="transactions_index" class="transactions-index">
    <div class="top">
        <div class="rows">
            <div class="form-group one">
                <label for="transactions_index_search_type" class="form-label">Select search with</label>
                <select name="search" id="transactions_index_search_type" class="form-select" onchange="searchTrigger()">
                    <option value="">Select an option</option>
                    <option value="user">User</option>
                    <option value="account">Account</option>
                </select>
            </div>

            <div class="form-group eight">
                <label for="transactions_index_search_text" class="form-label">Enter user or account name</label>
                <input type="text" id="transactions_index_search_text" placeholder="search user/account name" class="form-control" disabled onkeyup="getUsersAccounts()">
                <ul id="transactions_index_search_ul">
                </ul>
            </div>

            <div class="form-group one">
                <a href="{{ route('transactions.create') }}" id="transactions_index_create" class="btn btn-success">Create</a>
            </div>
        </div>

        <div class="rows">
            <div class="form-group one">
                <label for="transactions_index_from" class="form-label">From</label>
                <input type="text" id="transactions_index_from" name="from" class="form-control" autocomplete="OFF">
            </div>

            <div class="form-group one">
                <label for="transactions_index_to" class="form-label">To</label>
                <input type="text" id="transactions_index_to" name="to" class="form-control" autocomplete="OFF">
            </div>

            <div class="form-group two">
                <label for="transactions_index_status" class="form-label">Select status</label>
                <select name="status" id="transactions_index_status" class="form-select" onchange="transactionsIndexTableLoader()">
                    <option value="all" selected>Select a status</option>
                    <option value="all">All</option>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="banned">Banned</option>
                    <option value="deleted">Deleted</option>
                    <option value="restricted">Restricted</option>
                </select>
            </div>

            <div class="form-group two">
                <label for="transactions_index_type" class="form-label">Select type</label>
                <select name="type" id="transactions_index_type" class="form-select" onchange="transactionsIndexTableLoader()">
                    <option value="all" selected>Select a type</option>
                    <option value="sell">Sell</option>
                    <option value="purchase">Purchase</option>
                    <option value="salary">Salary</option>
                    <option value="deposite">Deposite</option>
                    <option value="withdraw">Withdraw</option>
                    <option value="transfer">Transfer</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div id="transactions_index_table_container" class="table-container">
        <table class="table table-dark table-bordered">
            <thead>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Type</th>
                <th>Status</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr class="clickable" data-href="{{ route('transactions.show',$transaction->id) }}">
                    <td>{{ date('Y-m-d',strtotime($transaction->created_at)) }}</td>
                    <td>{{ (strcmp($transaction->from_select,'user')==0) ? $transaction->fromUser->name : $transaction->fromAccount->name }}</td>
                    <td>{{ (strcmp($transaction->to_select,'user')==0) ? $transaction->toUser->name : $transaction->toAccount->name }}</td>
                    <td>{{ ucwords($transaction->type) }}</td>
                    <td>{{ ucwords($transaction->status) }}</td>
                    <td>{{ $transaction->amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $("#transactions_index_from").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        yearRange: '1970:2100'
    });
    $("#transactions_index_from").datepicker("option","showAnim","blind");
    $("#transactions_index_from").datepicker("option","dateFormat","yy-mm-dd");
    $("#transactions_index_to").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        yearRange: '1970:2100'
    });
    $("#transactions_index_to").datepicker("option","showAnim","blind");
    $("#transactions_index_to").datepicker("option","dateFormat","yy-mm-dd");
</script>
