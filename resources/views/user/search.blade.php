@if (count($users) < 1)
<span class="index-error">No data found!!</span>
@else
<table class="table table-dark table-bordered">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Role</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr class="clickable" data-href="{{ route('users.show',$user->id) }}">
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ ucwords($user->status) }}</td>
            <td>{{ ucwords($user->role) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
