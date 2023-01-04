<div id="transactions_show" class="transactions-show">
    <div class="top">
        <h2>Transaction Details</h2>
        <div class="btn-container">
            <a href="{{ route('transactions.index') }}" id="transactions_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('transactions.edit',$transaction->id) }}" id="transactions_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="transactions_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>

    <div class="image">

        @if ((strcmp($transaction->picture,'')!==0))

        <img src="{{ asset('images/'.$transaction->picture) }}" alt="Transaction profile picture" id="transactions_show_picture">

        @else
            @if (strcmp('male',$transaction->gender)==0)

            <img src="{{ asset('images/default_transaction_picture_male.png') }}" alt="Default profile picture" id="transactions_show_picture">

            @elseif (strcmp('female',$transaction->gender)==0)

            <img src="{{ asset('images/default_transaction_picture_female.png') }}" alt="Default profile picture" id="transactions_show_picture">

            @else

            <img src="{{ asset('images/default_transaction_picture_other.png') }}" alt="Default profile picture" id="transactions_show_picture">

            @endif
        @endif

        <button id="transactions_show_change_image" class="btn btn-outline-primary change-image hide">Change Image</button>
        <form action="{{ route('transactions.change-image',$transaction->id) }}" method="POST" id="show_transaction_change_image_form" enctype="multipart/form-data">
            @csrf
            <input type="file" name="picture" id="transactions_show_change_image_file" accept="image/*" hidden>
            <button type="submit" class="btn btn-primary hide">Save Image</button>
        </form>
    </div>

    <div class="details">
        <label for="" class="form-label"><span>Name: </span>{{ $transaction->name.' ['.ucwords($transaction->role).']' }}</label>
        <label for="" class="form-label"><span>Email: </span>{{ $transaction->email }}</label>
        <label for="" class="form-label"><span>Phone: </span>{{ $transaction->phone }}</label>
        <label for="" class="form-label"><span>Transaction Name: </span>{{ $transaction->transaction_name }}</label>
        <label for="" class="form-label"><span>Gender: </span>{{ ucwords($transaction->gender) }}</label>

        @if (strcmp($transaction->role,'customer')!==0)
        <label for="" class="form-label"><span>Salary: </span>{{ $transaction->salary }}</label>
        @endif

        <label for="" class="form-label"><span>Date of birth: </span>{{ $transaction->date_of_birth }}</label>
        <label for="" class="form-label"><span>Address: </span>{{ $transaction->address }}</label>
        <label for="" class="form-label"><span>Shop Name: </span>{{ $transaction->shop->shop_name }}</label>

        @if (checkSuperAdmin()||checkAdmin())
        <label for="" class="form-label"><span>Created at: </span>{{ $transaction->created_at->diffForHumans() }}</label>
        <label for="" class="form-label"><span>Updated at: </span>{{ $transaction->updated_at->diffForHumans() }}</label>
        @endif
    </div>
</div>

<div id="transactions_delete" class="transactions-delete hide">
    <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST" id="transactions_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="transactions_delete_password" placeholder="enter your password" class="form-control">
        <span class="transactions-delete-error" id="transactions_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="transactions_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>

<div id="transaction_show_image_viewer" class="transaction-show-image-viewer hide">
    <img src="" alt="">
    <span id="transaction_show_image_viewer_close"><i class="fa-solid fa-x"></i></span>
</div>
