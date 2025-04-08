<?php

namespace App\Http\Controllers\Auth;

use App\Models\Talent\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Talent\recruit_app_info;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
     * @return \App\Models\User
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:recruit_app_users'],
            'password'        => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required','same:password', 'string', 'min:8']
        ]);
        if ($validator->fails()) { //validation failure
            return response()->json(['success'=>false, 'data' =>null, 'message' =>$validator->errors()->first(),'code' => 400]);
        }
        $info_id = recruit_app_info::where('company_id', companyId())->max('applicant_id');
        $user_id = User::where('company_id', companyId())->max('applicant_id');
        $applicant_id = max($info_id,$user_id) + 1;
        $user= User::create([
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'company_id'    => companyId(),
            'applicant_id'  =>  $applicant_id
        ]);
        $user->sendEmailVerificationNotification();

        return response()->json(['user' => $user, 'message' => 'Please check your email to activate your account']);
    }
}
