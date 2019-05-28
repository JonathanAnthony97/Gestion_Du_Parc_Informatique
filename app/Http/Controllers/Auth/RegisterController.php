<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Response;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return redirect()->route('base');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    

    public function register(Request $request)
    {
       $validator=Validator::make($request->all(),[
            'Username' => 'required|max:255',
            'Email' => 'required|email|max:255|unique:users',
            'Password' => 'required|min:6|confirmed'
                ]);

       if($validator->fails())
            {
                return Response::json(['errors'=>$validator->errors()]);
            }else{
                $user = new User();
                $user->username = $request->Username;
                $user->email = $request->Email;
                $user->password = bcrypt($request->Password);
                $user->save();

                Auth::guard()->attempt(['username'=>$request->Username,'password'=>$request->Password]);
        
            }
            /*,$request->remember=true*/
    }
}
