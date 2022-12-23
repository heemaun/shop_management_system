@if (count($accounts) < 1)
<span class="index-error">No data found!!</span>
@else
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
@endif
