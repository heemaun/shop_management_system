<div id="sells_show" class="sells-show">
    <div class="top">
        <h2>Sell Details</h2>
        <div class="btn-container">
            <a href="{{ route('sells.index') }}" id="sells_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('sells.edit',$sell->id) }}" id="sells_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="sells_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>

    <div class="middle">
        <div class="sides">
            <label for="" class="form-label"><span>ID: </span>{{ '#'.$sell->id }}</label>
            <label for="" class="form-label"><span>Shop Name: </span>{{ $sell->shop->shop_name }}</label>
            <label for="" class="form-label"><span>Seller: </span>{{ $sell->user->name }}</label>
        </div>
        <div class="sides">
            <label for="" class="form-label"><span>Date: </span>{{ date('l, F - d, Y', strtotime($sell->created_at)) }}</label>
            <label for="" class="form-label"><span>Time: </span>{{ date('h:m:i A', strtotime($sell->created_at)) }}</label>
            <label for="" class="form-label"><span>Customer: </span>{{ $sell->customer->name }}</label>
        </div>
    </div>

    <div class="sell-orders">
        <table class="table table-dark table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Units</th>
                    <th>Sub-total</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sell->sellOrders as $so)
                <tr class="clickable" data-href="{{ route('sell-orders.show', $so->id) }}">
                    <td class="center">{{ $loop->iteration }}</td>
                    <td class="center">{{ $so->product->name }}</td>
                    <td class="right">{{ $so->unit_price }}</td>
                    <td class="right">{{ $so->units }}</td>
                    <td class="right">{{ $so->subtotal }}</td>
                    <td class="right">{{ $so->discount }}</td>
                    <td class="right">{{ $so->subtotal - $so->discount }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <thead>
                    <tr>
                        <th colspan="5" rowspan="4" class="center">Order Count: {{ $sell->total_order_count }} Product Count: {{ $sell->total_product_count }}</th>
                        <th class="left">Grand Total</th>
                        <td class="right">{{ $sell->total_price }}</td>
                    </tr>
                    <tr>
                        <th class="left">Less</th>
                        <td class="right">{{ $sell->less }}</td>
                    </tr>
                    <tr>
                        <th class="left">Vat</th>
                        <td class="right">{{ $sell->vat }}</td>
                    </tr>
                    <tr>
                        <th class="left">Final Total</th>
                        <td class="right">{{ $sell->total_price - $sell->less + $sell->vat }}</td>
                    </tr>
                </thead>
            </tfoot>
        </table>
    </div>

    @if (count($sell->transactions)>0)
    <h3>Payments</h3>
    <div class="payments">
        <table class="table table-dark table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>Transaction Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sell->transactions as $t)
                <tr>
                    <td class="center">{{ date('Y-m-d h:m:i A',strtotime($t->created_at)) }}</td>
                    <td class="right">{{ '#'.$t->id }}</td>
                    <td class="right">{{ $t->amount }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="right" colspan="2">Total</th>
                    <td class="right">{{ $total_payment }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endif

</div>

<div id="sells_delete" class="sells-delete hide">
    <form action="{{ route('sells.destroy',$sell->id) }}" method="POST" id="sells_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="sells_delete_password" placeholder="enter your password" class="form-control">
        <span class="sells-delete-error" id="sells_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="sells_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>
