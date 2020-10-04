<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

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

    //use トレイト名
    //このようにしてこのクラスにおいて、トレイト内で定義している機能が使える
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //alpha_numは英数字であるか、unique:usersはusersテーブルの他のレコードのnameカラムにリクエストされたnameと同じ値がないかチェック
            'name' => ['required', 'string', 'alpha_num', 'min:3', 'max:16', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showProviderUserRegistrationForm(Request $request, string $provider)
    {
        $token = $request->token;
        //userFromTokenメソッドではproviderから発行済みのトークンを使い、providerのAPIに再度ユーザー情報の問い合わせを行う
        $providerUser = Socialite::driver($provider)->userFromToken($token);

        return view('auth.social_register', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $token,
        ]);
    }

    public function registerProviderUser(Request $request, string $provider)
    {
        $request->validate([
            'name' => ['required', 'string', 'alpha_num', 'min:3', 'max:16', 'unique:users'],
            'token' => ['required', 'string'],
        ]);

        //$request->tokenにより、Googleから発行済みトークンの値を取得
        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        //ユーザーモデルのインスタンスの作成
        $user = User::create([
            'name' => $request->name,
            'email' => $providerUser->getEmail(),
            'password' => null,
        ]);

        //RegistersUsersトレイトのregisterメソッド内のコードを参照
        $this->guard()->login($user, true);
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
