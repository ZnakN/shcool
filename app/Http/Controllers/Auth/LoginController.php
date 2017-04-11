<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function login(\Illuminate\Http\Request $request) {
      $email = $request->input('email');
      $password = $request->input('password');
      $remember = $request->input('remember','');
      
      if ($remember)
      {
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1],$remember)) {
        // The user is active, not suspended, and exists.
            $path = $this->redirectTo;  
        }
        else
        {
          return $this->sendFailedLoginResponse($request);
        }
      }
      else
      {
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
        // The user is active, not suspended, and exists.
          $path = $this->redirectTo;
        }
        else
        {
          return $this->sendFailedLoginResponse($request);
        }
      }
      
      return redirect($path);
  }
}
