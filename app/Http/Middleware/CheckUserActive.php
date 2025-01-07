<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Verifica se o usuário está autenticado e ativo
        if (Auth::check() && !Auth::user()->ativo) {
            Auth::logout(); // Desloga o usuário inativo

            // Redireciona para a página de login com mensagem de erro
            return redirect()->route('login')->withErrors([
                'email' => 'Sua conta está inativa. Entre em contato com o administrador.',
            ]);
        }

        //Permite que a requisição continue caso o usuário esteja ativo.
        return $next($request);
    }
}
