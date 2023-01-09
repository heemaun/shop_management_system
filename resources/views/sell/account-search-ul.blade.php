@foreach ($accounts as $account)
<li class="ul-clickable" data-id="{{ $account->id }}">{{ $account->name }}</li>
@endforeach
