<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Shop Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome/all.min.css') }}">

        @if (checkLogin())

        <style>
            :root{
                --margin_left: 91px;
            }
        </style>

        @else

        <style>
            :root{
                --margin_left: 0px;
            }
        </style>

        @endif

        <link rel="stylesheet" href="{{ asset('css/system/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/system/home.css') }}">

        @if (checkLogin())

        <link rel="stylesheet" href="{{ asset('css/accounts/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/accounts/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/accounts/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/accounts/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/category/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/category/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/category/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/category/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/product/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/product/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/product/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/product/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/purchase/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/purchase/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/purchase/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/purchase/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/purchase-order/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/purchase-order/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/purchase-order/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/purchase-order/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/sell/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sell/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sell/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sell/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/sell-order/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sell-order/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sell-order/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sell-order/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/settings/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/settings/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/settings/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/settings/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/shop/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shop/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shop/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shop/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/transaction/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/transaction/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/transaction/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/transaction/show.css') }}">

        <link rel="stylesheet" href="{{ asset('css/user/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/user/edit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/user/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/user/show.css') }}">
        @endif
    </head>
    <body>
        <header>
            <nav>
                <a href="{{ route('index') }}" id="logo" class="logo">Logo</a>
                <ul>
                    <li id="home">Home</li>
                    <li id="products">Products</li>
                    <li id="contacts">Contacts</li>
                </ul>
                @if (checkLogin())
                <span id="nav_option_trigger" class="nav-option-trigger">{{ getUser()->name }}</span>
                <ul id="nav_options" class="nav-options hide">
                    <li><a href="{{ route('users.show',getUser()->id) }}">Profile</a></li>
                    <li><a href="{{ route('settings.index') }}">Settings</a></li>
                    <li id="change_password_trigger">Change Password</li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
                @else
                <ul >
                    <li id="login_trigger">Login</li>
                    <li id="register_trigger">Register</li>
                </ul>
                @endif
            </nav>
        </header>


        <section id="content_loader" class="content-loader">

        </section>

        @if (checkLogin())

        <aside>
            <ul>
                @if (checkSuperAdmin() || checkAdmin())
                <li id="admin">Admins</li>
                @endif
                @if (checkSuperAdmin() || checkAdmin()||checkManager())
                <li id="manager">Managers</li>
                @endif
                @if (checkSuperAdmin()||checkAdmin()||checkManager()||checkSeller())
                <li id="seller">Sellers</li>
                @endif
                @if (checkSuperAdmin()||checkAdmin()||checkManager()||checkSeller()||checkCustomer())
                <li id="customer">Customers</li>
                @endif
            </ul>
        </aside>

        @if (checkSuperAdmin() || checkAdmin())

        <section id="admin_panel" class="admin-panel hidden">
            <ul>
                <li id="admin_panel_dashboard"><a href="#">Dashboard</a></li>
                <li id="admin_panel_craete"><a href="{{ route('users.create') }}">Create</a></li>
                <li id="admin_panel_index"><a href="{{ route('users.index') }}">Index</a></li>
            </ul>
        </section>

        @endif

        @if (checkSuperAdmin() || checkAdmin()||checkManager())

        <section id="manager_panel" class="manager-panel hidden">
            <ul>
                @if (checkManager())
                <li id="manager_panel_dashboard"><a href="#">Dashboard</a></li>
                @endif
                @if (checkSuperAdmin() || checkAdmin())
                <li id="manager_panel_craete"><a href="{{ route('users.create') }}">Create</a></li>
                @endif
                <li id="manager_panel_index"><a href="{{ route('users.index') }}">Index</a></li>
            </ul>
        </section>

        @endif

        @if (checkSuperAdmin()||checkAdmin()||checkManager()||checkSeller())

        <section id="seller_panel" class="seller-panel hidden">
            <ul>
                @if (checkSeller())
                <li id="seller_panel_dashboard"><a href="#">Dashboard</a></li>
                @endif
                @if (checkSuperAdmin() || checkAdmin()||checkManager())
                <li id="seller_panel_craete"><a href="{{ route('users.create') }}">Create</a></li>
                @endif
                <li id="seller_panel_index"><a href="{{ route('users.index') }}">Index</a></li>
            </ul>
        </section>

        @endif

        @if (checkSuperAdmin()||checkAdmin()||checkManager()||checkSeller()||checkCustomer())

        <section id="customer_panel" class="customer-panel hidden">
            <ul>
                @if (checkCustomer())
                <li id="user_panel_dashboard"><a href="#">Dashboard</a></li>
                @endif
                @if (checkSuperAdmin() || checkAdmin()||checkManager())
                <li id="user_panel_craete"><a href="{{ route('users.create') }}">Create</a></li>
                @endif
                <li id="user_panel_index"><a href="{{ route('users.index') }}">Index</a></li>
            </ul>
        </section>

        @endif

        <section id="change_password_div" class="change-password-div hide">
            <form action="{{ route('change-password') }}" method="POST" id="change_password_form">
                <label for="chnage_password_old_password" class="form-label">Enter old password</label>
                <input type="password" name="old_password" id="chnage_password_old_password" placeholder="enter old password" class="form-control">
                <span class="change-password-error" id="change_password_old_password_error"></span>

                <label for="chnage_password_new_password" class="form-label">Enter new password</label>
                <input type="password" name="onew_password" id="chnage_password_new_password" placeholder="enter nre password" class="form-control">
                <span class="change-password-error" id="change_password_new_password_error"></span>

                <label for="chnage_password_password_confirmation" class="form-label">Confirm new password</label>
                <input type="password" name="password_confirmation" id="chnage_password_password_confirmation" placeholder="confirm new password" class="form-control">
                <span class="change-password-error" id="change_password_password_confirmation_error"></span>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <button type="button" id="change_password_close" class="btn btn-secondary">Close</button>
                </div>
            </form>
        </section>

        @else

        <section id="login_div" class="login-div hide">
            <form action="{{ route('login') }}" method="POST" id="login_form">
                <legend>Login Form</legend>
                @csrf
                <label for="login_user_name" class="form-label">User Name</label>
                <input type="text" name="user_name" id="login_user_name" class="form-control" placeholder="enter user name">
                <span class="login-error" id="login_user_name_error"></span>

                <label for="login_password" class="form-label">Password</label>
                <input type="password" name="password" id="login_password" class="form-control" placeholder="enter user password">
                <span class="login-error" id="login_password_error"></span>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <button type="button" id="login_close" class="btn btn-secondary">Close</button>
                </div>
            </form>
        </section>

        <section id="register_div" class="register-div hide">
            <form action="{{ route('users.store') }}" method="POST" id="register_form">
                @csrf
                <legend>New User registration Form</legend>
                <div class="rows">
                    <div class="columns">
                        <label for="register_name" class="form-label">Name</label>
                        <input type="text" name="name" id="register_name" class="form-control" placeholder="enter your name">
                        <span class="register-error" id="register_name_error"></span>

                        <label for="register_email" class="form-label">Email</label>
                        <input type="email" name="email" id="register_email" class="form-control" placeholder="enter your email">
                        <span class="register-error" id="register_email_error"></span>

                        <label for="register_phone" class="form-label">Phone</label>
                        <input type="phone" name="phone" id="register_phone" class="form-control" placeholder="enter your phone">
                        <span class="register-error" id="register_phone_error"></span>

                        <label for="register_user_name" class="form-label">User name</label>
                        <input type="phone" name="user_name" id="register_user_name" class="form-control" placeholder="enter your user name">
                        <span class="register-error" id="register_user_name_error"></span>

                        <label for="register_gender" class="form-label">Gender</label>
                        <select name="gender" id="register_gender" class="form-select">
                            <option value="">Select a gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="register-error" id="register_gender_error"></span>
                    </div>
                    <div class="columns">
                        <label for="register_password" class="form-label">Password</label>
                        <input type="password" name="password" id="register_password" class="form-control" placeholder="enter your password">
                        <span class="register-error" id="register_password_error"></span>

                        <label for="register_password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" name="password_confirmation" id="register_password_confirmation" class="form-control" placeholder="enter your password again">
                        <span class="register-error" id="register_password_confirmation_error"></span>

                        <label for="register_date_of_birth" class="form-label">Password Confirmation</label>
                        <input type="date" name="date_of_birth" id="register_date_of_birth" class="form-control" placeholder="enter your birthday">
                        <span class="register-error" id="register_date_of_birth_error"></span>

                        <label for="register_address" class="form-label">Address</label>
                        <textarea name="address" id="register_address" class="form-control"></textarea>
                        <span class="register-error" id="register_address_error"></span>
                    </div>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button type="button" id="register_close" class="btn btn-secondary">Close</button>
                </div>
            </form>
        </section>
        @endif

        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/font-awesome/all.min.js') }}"></script>
        <script src="{{ asset('js/system/index.js') }}"></script>
        <script src="{{ asset('js/system/home.js') }}"></script>
    </body>
</html>
