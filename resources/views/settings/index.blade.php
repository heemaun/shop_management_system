<div id="settings_index" class="settings-index">
    <div class="top">
        <input type="text" name="search" id="settings_index_search" class="form-control" placeholder="seach settings key">
    </div>
    <div id="settings_index_table_container" class="table-container">
        <table class="table table-dark table-bordered">
            <thead>
                <th>No</th>
                <th>Key</th>
                <th>Value</th>
                <th>Last Modified By</th>
            </thead>
            <tbody>
                @foreach ($settings as $s)
                <tr class="clickable" data-href="{{ route('settings.edit',$s->id) }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->key }}</td>
                    <td>{{ $s->value }}</td>
                    <td>{{ $s->user->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
