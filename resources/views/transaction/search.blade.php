@if (count($transactions) < 1)
<span class="index-error">No data found!!</span>
@else
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
@endif
