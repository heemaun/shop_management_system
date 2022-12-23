@foreach ($accounts as $account)
<tr class="clickable" data-href="{{ route('accounts.show',$account->id) }}">
    <td>{{ $account->name }}</td>
    <td>{{ $account->balance }}</td>
    <td>{{ $account->shop->shop_name }}</td>
</tr>
@endforeach
