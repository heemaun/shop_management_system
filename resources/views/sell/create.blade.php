<div id="sells_create" class="sells-create">
    <form action="{{ route('sells.store') }}" method="POST" id="sells_create_form" >
        @csrf

        <legend>Create New Sell</legend>

        <div class="top">
            <div class="rows one">
                <div class="form-group">
                    <label for="sells_create_user_text" class="form-label">Enter customer name, phone, email</label>
                    <input type="text" id="sells_create_user_text" placeholder="enter customer name" class="form-control" onkeyup="sellsCreateUserSearch()">
                    <input type="number" id="sells_create_user_id" hidden>
                    <ul id="sells_create_user_ul">

                    </ul>
                    <span class="sells-create-error" id="sells_create_user_id_error"></span>
                </div>
            </div>
            <div class="rows">
                <div class="form-group">
                    <label for="sells_create_product_text" class="form-label">Product name or id</label>
                    <input type="text" id="sells_create_product_text" placeholder="enter product name" class="form-control" onkeyup="sellsCreateProductSearch()">
                    <input type="number" id="sells_create_product_id" hidden>
                    <ul id="sells_create_product_ul">

                    </ul>
                    <span class="sells-create-error" id="sells_create_product_id_error"></span>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Unit Price</label>
                    <label id="sells_create_product_unit_price" class="form-label custom-label">0</label>
                </div>

                <div class="form-group">
                    <label for="sells_create_product_units" class="form-label">Enter units</label>
                    <input type="number" id="sells_create_product_units" placeholder="enter product units" class="form-control" min="1" onchange="productDetailsChange()" onkeyup="productDetailsChange()" disabled>
                    <span class="sells-create-error" id="sells_create_units_error"></span>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Subtotal</label>
                    <label id="sells_create_product_subtotal" class="form-label custom-label">0</label>
                </div>

                <div class="form-group">
                    <label for="sells_create_product_discount" class="form-label">Discount</label>
                    <input type="number" id="sells_create_product_discount" placeholder="enter product discount" class="form-control" min="0" onchange="productDetailsChange()" onkeyup="productDetailsChange()" disabled>
                    <span class="sells-create-error" id="sells_create_discount_error"></span>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Total</label>
                    <label id="sells_create_product_total" class="form-label custom-label">0</label>
                </div>

                <div class="form-group">
                    <a href="{{ route('sell-orders.store') }}" data-sell-id="{{ $sell->id }}" id="sells_create_product_add" class="btn btn-success">Add</a>
                </div>
            </div>
        </div>

        <div id="sells_create_orders_table" class="orders-table">
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
                    @foreach ($sell->sellOrders->whereIn('status',['active','pending']) as $so)
                    <tr>
                        <td class="center">
                            <a href="{{ route('sell-orders.update',$so->id) }}" class="btn btn-success sell-create-sell-order-control sell-create-plus">+</a>
                            <a href="{{ route('sell-orders.update',$so->id) }}" class="btn btn-warning sell-create-sell-order-control sell-create-minus">-</a>
                            <a href="{{ route('sell-orders.destroy',$so->id) }}" class="btn btn-danger sell-create-sell-order-control sell-create-delete" data-user="{{ getUser() }}">X</a>
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
                        <td class="right" id="sells_total_price">{{ number_format((float)$sell->total_price,2,'.','') }}</td>
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
        </div>

        <div class="sells-create-payment">
            <h3>Payment</h3>
            <div class="rows">
                <div class="form-group">
                    <label for="sells_create_account_id" class="form-label">Enter account name</label>
                    <input type="text" id="sells_create_account_text" placeholder="enter account name" class="form-control" onkeyup="sellsCreateAccountSearch()">
                    <input type="number" id="sells_create_account_id" hidden>
                    <ul id="sells_create_account_ul">

                    </ul>
                    <span class="sells-create-error" id="sells_create_account_id_error"></span>
                </div>

                <div class="form-group">
                    <label for="sells_create_amount" class="form-label">Enter amount</label>
                    <input type="number" id="sells_create_amount" placeholder="enter payment amount" class="form-control">
                    <span class="sells-create-error" id="sells_create_amount_error"></span>
                </div>
            </div>
        </div>

        <div class="btn-container">
            <div class="sides">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ '#' }}" id="sells_create_clear" class="btn btn-warning">Clear</a>
            </div>

            <div class="sides">
                <a href="{{ route('sells.index') }}" id="sells_create_close" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
