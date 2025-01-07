<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    //protected $redirectTo = '/home';
    protected $redirectTo = '/adm';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override the login method to check if the user is active.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Verificar se o usuário existe e se está ativo
        $user = User::where('email', $credentials['email'])->first();

        if ($user && !$user->ativo) {
            return back()->withErrors([
                'email' => 'Sua conta está inativa. Por favor, entre em contato com o suporte.',
            ]);
        }

        // Se o usuário estiver ativo, tenta autenticar normalmente
        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            return redirect()->intended($this->redirectTo);
        }

        // Se falhar na autenticação
        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    }
}
