@foreach ($users as $user)
<li class="ul-clickable" data-id="{{ $user->id }}">{{ $user->name }}</li>
@endforeach
