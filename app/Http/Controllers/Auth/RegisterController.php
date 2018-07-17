<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/make';

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
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],
        [
          'name.required' => '名前は必ず入力してください',
          'name.string' => '文字で入力してください',
          'name.max' => 'もっと短い名前を入力してください',
          'name.unique' => 'その名前は既に使用されています',
          'email.required' => 'メールアドレスは必ず入力してください',
          'email.string' => '文字で入力してください',
          'email.email' => 'メールアドレスを入力してください',
          'email.max' => 'もっと短いメールアドレスを入力してください',
          'email.unique' => 'そのメールアドレスは既に使用されています',
          'password.required' => 'パスワードは必ず入力してください',
          'password.string' => '文字で入力してください',
          'password.min' => 'パスワードは６文字以上で入力してください',
          'password.confirmed' => '確認欄に入力されたパスワードが一致しません'
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function pre_check(Request $request){
        $this->validator($request->all())->validate();
        //flash data
        $request->flashOnly('name');
        $request->flashOnly('email');

        $bridge_request = $request->all();
        // password マスキング
        $bridge_request['password_mask'] = '******';

        return view('auth.register_check')->with($bridge_request);
    }

    public function register(Request $request)
    {
        event(new Registered($user = $this->create( $request->all() )));
        $this->guard()->login($user);
        return redirect('/make');
    }
}
