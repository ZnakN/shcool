<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmUser;
use Illuminate\Auth\Events\Registered;
use Symfony\Component\Console\Helper\Helper;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'=>'required'
        ]);
    }
    
    public function register(\Illuminate\Http\Request $request) {
     
      $this->validator($request->all())->validate();
      event(new Registered($user = $this->create($request->all())));
      flash('We send confirm letter to your email', 'success');
      return redirect('/login');
    
  }
  
  
  public function activate($code) {

    //ppre($code);
    if ($user = User::where('register_token', $code)->where('status', 0)->first()) {
      //ppr($user);    
      $user->activate();
      Auth::login($user);
      
    }
    else
    {
      flash('Wrong activate code', 'danger');
      return redirect('/login');
    }
    
      return redirect('/home');
    }

  /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $register_token = bcrypt($data['email']);
        
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'register_token'=>$register_token,
            'role'=>$data['role']
        ]);
        
        $this->send_confirm_email($user);
        
        return $user;
    }
    
    private function send_confirm_email($user)
    {
      Mail::to($user->email)->send(new ConfirmUser($user));
    }
}
