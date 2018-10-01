<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Mail;
use Modules\Admin\Entities\User;
use Route;
use Setting;
use Reminder;
use Activation;
use Exception;
use Sentinel;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{

    /**
    * Forgot Password Page
    */
    public function forgotPassword(){
        if (Setting::get('forgot-password-avalilability') == 'true') {
            return view('admin::auth.password-email');
        }else{
            abort(403);
        }
    }

    /**
    * Forgot Password Form is Submited Here
    */    
    public function postForgotPassword(Request $request){
        $this->validate($request , [
            'email' => 'required'
        ]);

        $user =  User::where('email' , $request->input('email'))->first();
    
        if (!$user) {

            return redirect()->route('admin.auth.forgot_password')->with([
                'status' => 'error' , 
                'message'=> 'Email Not Found'
            ]);

        }else{
            $reminder = Reminder::exists($user);

            //CREATE REMINDER IF DOES NOT EXISTS
            $reminder = Reminder::create($user); 
            $this->sendResetPasswordEmail($user , $reminder->code );

            return redirect()->route('admin.auth.forgot_password')->with([
                'status' => 'success' , 
                'message'=> 'Check Your Email'
            ]);
        }
    }

    /**
    * Change Password
    */
    public function changePassword(User $user , $code){
        return view('admin::auth.password-reset-form')->with(['token' => $code]);
    }

    public function postChangePassword(Request $request){
        //Validate User Input
        $this->validate($request , [
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->get();

        if (count($user) == 0) {

            abort(404);

        }else{
            $user = $user->first();
            
            if ($reminder = Reminder::exists($user)) {

                if ($request->input('token') == $reminder->code) {
                    //If provided code is the same with db reminder
                    if ($reminder = Reminder::complete($user, $request->input('token') , $request->input('password')))
                    {
                        // Reminder was successfull
                        return redirect()->route('admin.auth.login');
                    }
                    else
                    {
                        // Reminder not found or not completed.
                        abort(404);

                    }

                }else{

                    abort(404);

                }

            }else{

                abort(404);

            }
        }
    }

   /**
    * Send  Reset Password Link With Email
    */
    public function sendResetPasswordEmail($user , $code ){
        Mail::send('admin::auth.email.reset-password' , [
            'user' => $user,
            'code' => $code
        ], function($message) use ($user){

            $message->to($user->email);
            $message->subject("Reset Your Password");
        });
    }


}
