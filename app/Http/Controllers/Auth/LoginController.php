<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use TwitchApi;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * View of login page
     * @return type
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function login() {
        $data = [];
        $data['authURL'] = TwitchApi::getAuthenticationUrl();
        return view("User::login")->with("data", $data);
    }

    /**
     * check authentication
     * @param \App\Http\Controllers\Auth\Request $request
     * @return type
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function handleLogin(Request $request) {
        $obj = new TwitchApi;
        $code = $request->input('code');

        $response = TwitchApi::getAccessObject($code);
        TwitchApi::setToken($response['access_token']);

        // Get user object from Twitch
        $twitchUser = TwitchApi::authUser();
        $user = new User();
        $userinfo = $user->getUserInfo($twitchUser['_id']);

        if (empty($userinfo)) {
            $arr = [];
            $arr["twitch_id"] = $twitchUser['_id'];
            $arr["username"] = $twitchUser['name'];
            $arr["email"] = $twitchUser['email'];
            $arr["display_name"] = $twitchUser['display_name'];
            $arr["profile_url"] = $twitchUser['logo'];
            $arr["offline_url"] = $twitchUser['logo'];
            $arr["view_count"] = 0;
            $arr["token"] = $response['access_token'];
            $userinfo = User::updateOrCreate(["id" => 0], $arr);
        } else {
            $arr = [];
            $arr["token"] = $response['access_token'];
            $userinfo = User::updateOrCreate(["twitch_id" => $userinfo->twitch_id], $arr);
        }
        // Authenticate user
        Auth::login($userinfo);
        return Redirect::route('user.index');
    }

    /**
     * Logout 
     * @return type
     * @author Vijay Vyas <vijayvyas3802@gmail.com>
     */
    public function logout() {
        $arr = ['token' => ''];
        User::updateOrCreate(['id' => Auth::user()->id], $arr);
        
        $options = [
            'client_id' => config('twitch-api.client_id'),
            'token' => Auth::user()->token,
        ];
        
        TwitchApi::revokeToken($options);
        Session::flush();
        Auth::logout();
        Session::flash('flash_message', "You have successfully logged out");
        return redirect('login');
    }

}
