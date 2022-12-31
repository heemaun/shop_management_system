@if (count($settings) < 1)
<span class="index-error">No data found!!</span>
@else
<table class="table table-dark table-bordered">
    <thead>
        <th>No</th>
        <th>Key</th>
        <th>Value</th>
        <th>Last Modified By</th>
    </thead>
    <tbody>
        @foreach ($settings as $s)
        <tr class="clickable" data-href="{{ route('settings.show',$s->id) }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s->key }}</td>
            <td>{{ $s->value }}</td>
            <td>{{ $s->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
