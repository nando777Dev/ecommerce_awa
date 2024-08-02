<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Models\City;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register')
            ->with('cities', $this->prepareCities());
    }
    private function prepareCities(){
        $cities = City::all();
        $temp = [];
        foreach($cities as $c){
            // array_push($temp, $c->id => $c->nome);
            $temp[$c->id] = $c->nome . " ($c->uf)";
        }
        return $temp;
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        try {

            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'sobrenome' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Depuração: Exibir os dados do request

            $business_id = config('constants.business_id');
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->sobrenome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            // Adiciona o contato na tabela Contacts como cliente
            $user_id = $user->id;
            $customer = Contact::create([
                'business_id'=> $business_id,
                'city_id'=>$request->city_id,
                'name' => $request->first_name .' '. $request->sobrenome,
                'type' => 'customer',
                'cod_pais' => 1058,
                'consumidor_final' => 1,
                'contribuinte' => 1,
                'cpf_cnpj' => $request->cpf_cnpj,
                'datanasc' => $request->datanasc,
                'cep' => $request->cep,
                'rua' => $request->rua,
                'bairro' => $request->bairro,
                'numero' => $request->number,
                'mobile' => $request->rua,
                'email' => $request->email,
                'is_ecommerce' => 1,
                'created_by' => $business_id,
                'user_id'=>$user_id
            ]);

            // Depuração: Exibir o objeto User criado


            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);

        } catch (\Exception $e) {

            dd("Error: " . $e->getMessage(), "Line: " . $e->getLine());

            // Retornar com erro para o usuário (se necessário)
            return back()->withErrors(['error' => 'Ocorreu um erro ao tentar registrar o usuário.']);
        }
    }

}
