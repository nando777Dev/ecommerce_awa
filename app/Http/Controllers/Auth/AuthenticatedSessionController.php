<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   /* public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');


        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user || $user->user_ecommerce != 0) {
            return back()->withErrors([
                'email' => 'Usuário não autorizado a acessar o sistema.',
            ])->withInput();
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $userToken = Str::uuid()->toString();
            $request->session()->put('user_token', $userToken);

            // Armazenar o token em um cookie por 30 dias
            $cookie = cookie('user_token', $userToken, 60 * 24 * 30);

            return redirect()->intended(RouteServiceProvider::HOME)->cookie($cookie);
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }*/

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user || $user->user_ecommerce != 0) {
            return back()->withErrors([
                'email' => 'Usuário não autorizado a acessar o sistema.',
            ])->withInput();
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $userToken = Str::uuid()->toString();
            $request->session()->put('user_token', $userToken);


            // Armazenar o token em um cookie por 30 dias
            $cookie = cookie('user_token', $userToken, 60 * 24 * 30);

            return redirect()->intended(RouteServiceProvider::HOME)->cookie($cookie);
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Salva o conteúdo do carrinho na sessão
        $cartContent = Cart::getContent()->toJson();
        $request->session()->put('cart', $cartContent);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
