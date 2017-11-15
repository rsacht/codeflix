<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Estamos sobrescrevendo este método que pertence a trait AuthenticatedUsers
    //A função dela é capturar dados da request durante a autenticação do usuário
    //Queremos que ela verifique se o usuário é um administrador
    //Para isto vamos acrescentar a role na verificação de autenticação
    //Dessa forma será arescentado um and no sql com a coluna role para pegar usuários
    //administradores que tenham tal email, senha e admin
    protected function credentials(Request $request)
    {
        //Guardamos a request em uma variável e em seguida acrescentamos a role
        //para verificar se o usuário pe
        $data = $request->only($this->username(),'password');
        $data['role'] = User::ROLE_ADMIN;
        return $data;
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

}
