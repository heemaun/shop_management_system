@foreach ($results as $r)
<li class="ul-clickable" data-id="{{ $r->id }}">{{ $r->name }}</li>
@endforeach
