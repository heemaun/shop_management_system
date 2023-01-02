<div id="users_show" class="users-show">
    <div class="top">
        <h2>User Details</h2>
        <div class="btn-container">
            <a href="{{ route('users.index') }}" id="users_show_back" class="btn btn-secondary">Back</a>
            <a href="{{ route('users.edit',$user->id) }}" id="users_show_edit" class="btn btn-info">Edit</a>
            <button type="button" id="users_show_delete_trigger" class="btn btn-danger">Delete</button>
        </div>
    </div>

    <div class="image">

        @if ((strcmp($user->picture,'')!==0))

        <img src="{{ asset('images/'.$user->picture) }}" alt="User profile picture" id="users_show_picture">

        @else
            @if (strcmp('male',$user->gender)==0)

            <img src="{{ asset('images/default_user_picture_male.png') }}" alt="Default profile picture" id="users_show_picture">

            @elseif (strcmp('female',$user->gender)==0)

            <img src="{{ asset('images/default_user_picture_female.png') }}" alt="Default profile picture" id="users_show_picture">

            @else

            <img src="{{ asset('images/default_user_picture_other.png') }}" alt="Default profile picture" id="users_show_picture">

            @endif
        @endif

        <button id="users_show_change_image" class="btn btn-outline-primary change-image hide">Change Image</button>
        <form action="{{ route('users.change-image',$user->id) }}" method="POST" id="show_user_change_image_form" enctype="multipart/form-data">
            @csrf
            <input type="file" name="picture" id="users_show_change_image_file" accept="image/*" hidden>
            <button type="submit" class="btn btn-primary hide">Save Image</button>
        </form>
    </div>

    <div class="details">
        <label for="" class="form-label"><span>Name: </span>{{ $user->name.' ['.ucwords($user->role).']' }}</label>
        <label for="" class="form-label"><span>Email: </span>{{ $user->email }}</label>
        <label for="" class="form-label"><span>Phone: </span>{{ $user->phone }}</label>
        <label for="" class="form-label"><span>User Name: </span>{{ $user->user_name }}</label>
        <label for="" class="form-label"><span>Gender: </span>{{ ucwords($user->gender) }}</label>

        @if (strcmp($user->role,'customer')!==0)
        <label for="" class="form-label"><span>Salary: </span>{{ $user->salary }}</label>
        @endif

        <label for="" class="form-label"><span>Date of birth: </span>{{ $user->date_of_birth }}</label>
        <label for="" class="form-label"><span>Address: </span>{{ $user->address }}</label>
        <label for="" class="form-label"><span>Shop Name: </span>{{ $user->shop->shop_name }}</label>

        @if (checkSuperAdmin()||checkAdmin())
        <label for="" class="form-label"><span>Created at: </span>{{ $user->created_at->diffForHumans() }}</label>
        <label for="" class="form-label"><span>Updated at: </span>{{ $user->updated_at->diffForHumans() }}</label>
        @endif
    </div>
</div>

<div id="users_delete" class="users-delete hide">
    <form action="{{ route('users.destroy',$user->id) }}" method="POST" id="users_delete_form">
        @csrf
        @method("DELETE")
        <legend>Enter password to confirm delete</legend>

        <label for="password" class="form-label">Enter your password</label>
        <input type="password" name="password" id="users_delete_password" placeholder="enter your password" class="form-control">
        <span class="users-delete-error" id="users_delete_password_error"></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <button type="button" id="users_delete_close" class="btn btn-secondary">Close</button>
        </div>
    </form>
</div>

<div id="user_show_image_viewer" class="user-show-image-viewer hide">
    <img src="" alt="">
    <span id="user_show_image_viewer_close"><i class="fa-solid fa-x"></i></span>
</div>
