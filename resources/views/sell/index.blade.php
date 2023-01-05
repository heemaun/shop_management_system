<div id="sells_index" class="sells-index">
    <div class="top">
        <div class="rows">
            <input type="text" id="sells_index_search" placeholder="search user/account name" class="form-control" onkeyup="sellsIndexTableLoader()">
            <a href="{{ route('sells.create') }}" id="sells_index_create" class="btn btn-success">Create</a>
        </div>
        <div class="rows two">
            <div class="form-group">
                <label for="sells_index_from" class="form-label">From</label>
                <input type="text" id="sells_index_from" name="from" class="form-control" autocomplete="OFF">
            </div>

            <div class="form-group">
                <label for="sells_index_to" class="form-label">To</label>
                <input type="text" id="sells_index_to" name="to" class="form-control" autocomplete="OFF">
            </div>

            <div class="form-group">
                <label for="sells_index_status" class="form-label">Select status</label>
                <select name="status" id="sells_index_status" class="form-select" onchange="sellsIndexTableLoader()">
                    <option value="all" selected>Select a status</option>
                    <option value="all">All</option>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="banned">Banned</option>
                    <option value="deleted">Deleted</option>
                    <option value="restricted">Restricted</option>
                </select>
            </div>
        </div>
    </div>

    <div id="sells_index_table_container" class="table-container">
        <table class="table table-dark table-bordered">
            <thead>
                <th>Date</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Total Price</th>
            </thead>
            <tbody>
                @foreach ($sells as $sell)
                <tr class="clickable" data-href="{{ route('sells.show',$sell->id) }}">
                    <td>{{ date('Y-m-d h:m:s A',strtotime($sell->created_at)) }}</td>
                    <td>{{ $sell->customer->name }}</td>
                    <td>{{ ucwords($sell->status) }}</td>
                    <td>{{ $sell->total_price - $sell->less + $sell->vat }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $("#sells_index_from").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        yearRange: '1970:2100'
    });
    $("#sells_index_from").datepicker("option","showAnim","blind");
    $("#sells_index_from").datepicker("option","dateFormat","yy-mm-dd");
    $("#sells_index_to").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        yearRange: '1970:2100'
    });
    $("#sells_index_to").datepicker("option","showAnim","blind");
    $("#sells_index_to").datepicker("option","dateFormat","yy-mm-dd");
</script>
