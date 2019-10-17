<?php

namespace App\Listeners;

// use App\Listeners\Request;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Login;
use Auth;
use Session;
use App\Http\Controllers\Admin\PriviledgeController;

class UserLoggedIn
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */

    //TO Create Session Variable on Login Event
    public function handle(Login $event)
    {
        if(!empty(Auth::guard('admin')->user()->user_id))
        {
            Session::set('configuration', NULL);
            app('request')->session()->regenerate(true);
            app('request')->session()->put('message', "Hello I'm listener to admin");
            app('request')->session()->put('user_id', Auth::guard('admin')->user()->user_id);
            app('request')->session()->put('frecord_id', Auth::guard('admin')->user()->frecord_id);
            app('request')->session()->put('designer_id', Auth::guard('admin')->user()->designer_id);
            app('request')->session()->put('user_type', Auth::guard('admin')->user()->user_type);
            app('request')->session()->put('email_id', Auth::guard('admin')->user()->email_id);
            app('request')->session()->put('user_name', Auth::guard('admin')->user()->user_name);
            app('request')->session()->put('first_name', Auth::guard('admin')->user()->first_name);
            app('request')->session()->put('last_name', Auth::guard('admin')->user()->last_name);
            app('request')->session()->put('phone', Auth::guard('admin')->user()->phone);
            app('request')->session()->put('state', Auth::guard('admin')->user()->state);
            app('request')->session()->put('zipcode', Auth::guard('admin')->user()->zipcode);
            app('request')->session()->put('role_id', Auth::guard('admin')->user()->role_id);
            app('request')->session()->put('status', Auth::guard('admin')->user()->status);
            $result = app('App\Http\Controllers\Admin\PriviledgeController')->getByUsername();
            app('request')->session()->put('success', $result);  
        }
        elseif(!empty(Auth::guard('user')->user()->user_id))
        {

            $cart_session=Session::get('cart_session');
            if(empty($cart_session))
            {
                $cart_session=str_random(60);
            }
            Session::set('configuration', NULL);
            app('request')->session()->regenerate(true);
            app('request')->session()->put('message', "Hello I'm listener to user");
            app('request')->session()->put('user_id', Auth::guard('user')->user()->user_id);
            app('request')->session()->put('user_type', Auth::guard('user')->user()->user_type);
            app('request')->session()->put('email_id', Auth::guard('user')->user()->email_id);
            app('request')->session()->put('first_name', Auth::guard('user')->user()->first_name);
            app('request')->session()->put('middle_name', Auth::guard('user')->user()->middle_name);
            app('request')->session()->put('last_name', Auth::guard('user')->user()->last_name);
            app('request')->session()->put('phone_no', Auth::guard('user')->user()->phone_no);
            app('request')->session()->put('state', Auth::guard('user')->user()->state);
            app('request')->session()->put('zipcode', Auth::guard('user')->user()->zipcode);
            app('request')->session()->put('status', Auth::guard('user')->user()->status);
            app('request')->session()->put('cart_session',$cart_session);

            // $result = app('App\Http\Controllers\Admin\PriviledgeController')->getByUsername();
            // app('request')->session()->put('success', $result); 
        }
    }
}