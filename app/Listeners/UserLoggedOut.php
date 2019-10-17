<?php

namespace App\Listeners;

// use App\Listeners\Request;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Logout;
use Session;
use Auth;
// use App\Classes\Helper;



class UserLoggedOut
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
    public function handle(Logout $event){
        if(!empty(Auth::guard('admin')->user()->user_id))
        {
            Session::flush();
            Session::regenerate(true);
        }
        elseif(!empty(Auth::guard('user')->user()->user_id))
        {
            Session::set('configuration', NULL);
            Session::forget('message');
            Session::forget('phone_no');
            Session::forget('user_id');
            Session::forget('user_type');
            Session::forget('email_id');
            Session::forget('first_name');
            Session::forget('middle_name');
            Session::forget('last_name');
            Session::forget('state');
            Session::forget('zipcode');
            Session::forget('status');
        }
        // Session::set('configuration', NULL);
        // Helper::unloadConfiguration();
    
    }
}