<div id="accounts_index" class="accounts-index">
    <div class="top">
        <input type="text" name="search" id="accounts_index_search" class="form-control" placeholder="seach accounts name">
        <a href="{{ route('accounts.create') }}" id="accounts_index_create" class="btn btn-success">Create</a>
    </div>
    <div id="accounts_index_table_container" class="table-container">
        <table class="table table-dark table-bordered">
            <thead>
                <th>Name</th>
                <th>Balance</th>
                <th>Shop Name</th>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                <tr class="clickable" data-href="{{ route('accounts.show',$account->id) }}">
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->balance }}</td>
                    <td>{{ $account->shop->shop_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
