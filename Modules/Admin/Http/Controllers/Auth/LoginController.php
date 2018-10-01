<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Mail;
use Route;
use Setting;
use Reminder;
use Activation;
use Exception;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class LoginController extends Controller
{
    /**
    * Login Page
    */
    public function login(){
        return view('admin::auth.login');
    }

    /**
    * Authenticate User Against Credentials
    */
    public function authenticate(Request $request){

        //Validate User Input
        $this->validate($request , [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $remember = ($request->input('remember')) ? true : false ;

        try{
            $logged_in = Sentinel::authenticate($request->only(['email' ,'password'] , $remember));
        }catch (ThrottlingException $e){
            return view('backend.auth.throttle',compact('e'));
        }

        if ($logged_in) {
            $backend_entry_point = (Setting::get('backend-entry-point')) ? Setting::get('backend-entry-point') : 'admin.auth.login';
            return redirect()->route($backend_entry_point);
        }else{
            return redirect()->route('admin.auth.login')->with([
                'auth_failed' => __('admin::admin.auth-failed')
            ]);
        }

    }

    /**
    * Logout User
    */
    public function logout(){
        Sentinel::logout();
        Session::forget('ticket_count');

        return redirect()->route('admin.auth.login');
    }

}
