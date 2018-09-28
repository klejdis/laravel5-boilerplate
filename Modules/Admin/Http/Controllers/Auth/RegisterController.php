<?php

namespace Modules\Admin\Http\Controllers\Auth;


use Mail;
use Route;
use Setting;
use Reminder;
use Activation;
use Exception;
use Sentinel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    /**
    * Register Form
    */
    public function register(){
        if (Setting::get('activation-availability') == 'true') {
             return view('backend.auth.register');
        }
       
       return redirect()->back();
    }


    /**
    * @param Request
    * Register Form is Submited Here
    */
    public function postRegister(Request $request){
      $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
      ]);

      $automatic_activation = (Setting::get('automatic-activation-after-register') == 'true') ? true : false;

      $user = Sentinel::register( $request->only(['email' , 'password']) , $automatic_activation);

      if (Setting::get('activation-type')['selected'] == 'email') {

          $activation =  Activation::create($user);
          $this->sendActivationEmail($user , $activation);

      }

      return redirect()->route('admin.auth.login');
    }


    /**
    * Active User Account
    */
    public function activate(User $user , $activation){
        $activation = Activation::exists($user);

        if ($activation) {
            if (Activation::complete($user , $activation->code)) {
                // Activation was successfull
                 return redirect()->route('admin.auth.login');
            }else{
                // Activation not found or not completed.
                abort(404);
            }
        }
    }

    /**
    * @param User
    * @param Activation
    * Send Email for Account Activation
    */
    protected function sendActivationEmail($user , $activation){
        Mail::send('backend.auth.email.activate-account' , [
            'user' => $user,
            'code' => $activation
        ], function($message) use ($user){
            $message->to($user->email);
            $message->subject("Activate Your Account");
        });
    }

}
