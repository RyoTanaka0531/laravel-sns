<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //providerの認証ページへユーザーをリダイレクト
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    //providerからユーザー情報を取得
    public function handleProviderCallback(Request $request, string $provider)
    {
        //stateless()はセッション状態の確認を無効化しているメソッド
        $providerUser = Socialite::driver($provider)->stateless()->user();
        //providerから取得したユーザー情報からメールアドレスを取り出し、そのメールアドレスが本サービスのusers
        //テーブルに存在するか調べている
        $user = User::where('email', $providerUser->getEmail())->first();

        if($user){
            //ログイン状態にする
            //loginメソッドの第二引数をtrueにすることで、ログアウト操作をしない限りログイン状態が維持される
            $this->guard()->login($user, true);
            return $this->sendLoginResponse($request);
        }
    }
}
