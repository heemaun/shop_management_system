<table class="table table-dark table-bordered table-stripped table-hover caption-top">
    <caption>Order List</caption>
    <thead>
        <tr>
            <th>Action</th>
            <th>No.</th>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Units</th>
            <th>Subtotal</th>
            <th>Discount</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($sell->sellOrders as $so)
        <tr>
            <td class="center">
                <a href="{{ '#' }}" class="btn btn-success">+</a>
                <a href="{{ '#' }}" class="btn btn-warning">-</a>
                <a href="{{ '#' }}" class="btn btn-danger">X</a>
            </td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $so->product->name }}</td>
            <td class="right">{{ number_format((float)$so->unit_price,2,'.','') }}</td>
            <td class="right">{{ number_format((float)$so->units,2,'.','') }}</td>
            <td class="right">{{ number_format((float)$so->subtotal,2,'.','') }}</td>
            <td class="right">{{ number_format((float)$so->discount,2,'.','') }}</td>
            <td class="right">{{ number_format(((float)$so->subtotal - (float)$so->discount),2,'.','') }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th colspan="6" rowspan="4" class="center">Order Count: <span id="sells_create_order_count">{{ $sell->total_order_count }}</span> Product Count: <span id="sells_create_product_count">{{ $sell->total_product_count }}</span></th>
            <th class="left">Grand Total</th>
            <td class="right" id="sells_total_price">{{ number_format((float)$so->total_price,2,'.','') }}</td>
        </tr>
        <tr>
            <th class="left less">
                <label for="">Less</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="less" id="sells_less_cash" checked>
                    <label class="form-check-label" for="sells_less_cash">Cash</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="less" id="sells_less_percentage">
                    <label class="form-check-label" for="sells_less_percentage">%</label>
                </div>
                <input type="number" id="sells_create_less_text" class="form-control input-sm">
            </th>
            <td class="right">{{ number_format((float)$sell->less,2,'.','') }}</td>
        </tr>
        <tr>
            <th class="left">Vat</th>
            <td class="right" id="sells_total_vat">{{ number_format((float)$sell->vat,2,'.','') }}</td>
        </tr>
        <tr>
            <th class="left">Final Total</th>
            <td class="right" id="sells_total_price">{{ number_format(($sell->total_price - $sell->less + $sell->vat),2,'.','') }}</td>
        </tr>
    </tfoot>
</table>
