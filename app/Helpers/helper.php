<?php

use App\Models\User;
use Illuminate\Support\Facades\Session;
function checkLogin()
{
    if(Session::has('user_id')){
        return true;
    }
    return false;
}

function getUser()
{
    if(checkLogin()){
        return User::where('id',Session::get('user_id'))->first();
    }
    return null;
}
?>
