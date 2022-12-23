@if (count($categories) < 1)
<span class="index-error">No data found!!</span>
@else
<table class="table table-dark table-bordered">
    <thead>
        <th>Name</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr class="clickable" data-href="{{ route('categories.show',$category->id) }}">
            <td>{{ $category->name }}</td>
            <td>{{ ucwords($category->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
