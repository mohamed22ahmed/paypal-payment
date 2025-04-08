<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\Talent\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Talent\recruit_app_info;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Talent\recruit_app_social;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember_me = $request->has('remember_me') ? true : false;

        if(Auth::attempt($credentials,$remember_me))
        {
            $user= User::where('email',$request->email)->first();
            if($user->email_verified_at == null)
                return response()->json(['error' => 'Your email address is not verified.'],403);
            $token = $user->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function clientIdGoogle()
    {
        $companyId = companyId();
        $client_id      =  recruit_app_social::where('company_id',$companyId)->where('provider_type', 2)->value('client_id');
        return $client_id;
    }

    public function appIdFacebook()
    {
        $companyId = companyId();
        $app_id      =  recruit_app_social::where('company_id',$companyId)->where('provider_type', 1)->value('client_id');
        return $app_id;
    }

    public function loginUsingGoogle(Request $request)
    {
        $user       =  User::where('email',$request->email)->first();
        if($user){
                Auth::login($user);
                $user->provider_type = 2;
                $user->provider_id =  $request->userId;
                $user->save();
                return '';
        }
        else{
            $info_id = recruit_app_info::where('company_id', companyId())->max('applicant_id');
            $user_id = User::where('company_id', companyId())->max('applicant_id');
            $applicant_id = max($info_id,$user_id) + 1;
            $user = User::create([
                'email'         => $request->email,
                'password'      => bcrypt('google'),
                'company_id'    => companyId(),
                'applicant_id'  => $applicant_id,
                'provider_id'   => $request->userId,
                'provider_type' => 2,
                ]);
                Auth::login($user);
                return '';
            }
    }

    public function loginUsingFacebook(Request $request)
    {
        $user =  User::where('email',$request->email)->first();
        if($user){
            Auth::login($user);
            $user->provider_id   = $request->userId;
            $user->provider_type =1;
            $user->save();
            return '';
        }else{
        $user = User::create([
            'email'         => $request->email,
            'password'      => bcrypt('fadia'),
            'company_id'    => companyId(),
            'applicant_id'  =>  User::where('company_id', companyId())->max('applicant_id') + 1,
            'provider_id'   => $request->userId,
            'provider_type' => 1,
            ]);
            Auth::login($user);
            return '';
        }
    }
}

