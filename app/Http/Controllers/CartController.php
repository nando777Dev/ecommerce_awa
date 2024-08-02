<?php

namespace App\Http\Controllers;
use App\Models\DummyCart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cartList()
    {

        $userID = Auth::id();
        $business_id = request()->session()->get('user');
        // Criar logina para validar se o usuário esta logado
        $itens = DummyCart::where('usuario_id', $userID)->get()->toArray();
        $url = config('constants.URL_IMAGES');

        $itemCount = count($itens);

        return view('cart.index', compact('itens', 'url', 'itemCount'));
    }

    public function addToCart(Request $request)
    {
        $userID = Auth::id();
        $business_id = config('constants.business_id');


        $cart = DummyCart::where('usuario_id', $userID)
            ->where('status', 'open')
            ->first();

        // Se não houver um carrinho "open" existente, crie um novo cart_id
        if (!$cart) {
            $cart_id = Str::uuid();  // Cria um UUID único
        } else {
            $cart_id = $cart->cart_id;  // Usa o cart_id do carrinho existente
        }

        // Tente encontrar o item no carrinho
        $dummyCart = DummyCart::where('usuario_id', $userID)
            ->where('status', 'open')
            ->where('id_produto', $request->id_produto)
            ->where('cart_id', $cart_id)
            ->first();

        if ($dummyCart) {
            // Atualiza a quantidade do produto existente no carrinho
            $dummyCart->quantity += $request->quantidade;
            $dummyCart->save();
        } else {
            // Adiciona novo item ao carrinho
            $dummyCart = new DummyCart();
            $dummyCart->business_id = $business_id;
            $dummyCart->usuario_id = $userID;
            $dummyCart->cart_id = $cart_id;
            $dummyCart->id_produto = $request->id_produto;
            $dummyCart->nome = $request->nome_produto;
            $dummyCart->price = $request->price;
            $dummyCart->quantity = $request->quantidade;
            $dummyCart->image = $request->img;
            $dummyCart->status = 'open';
            $dummyCart->save();
        }

        return back()->with('success', 'Item  adicionado com sucesso ao seu carrinho!');
    }



    public function viewCart()
    {
        $userID = Auth::id();
        $business_id = config('constants.business_id');
        // Criar logina para validar se o usuário esta logado
        $itens = DummyCart::where('usuario_id', $userID)->get()->toArray();



        $config_popup = DB::table('config_ecommerce_popups')
                ->where('business_id', $business_id)
                ->get()
                ->toArray();

                $popups = $config_popup;

                $filteredPopups = array_filter($popups, function($popup) {
                    return strpos($popup->page_popup, 'cart') !== false;
                });



        $url = config('constants.URL_IMAGES');

        $itemCount = count($itens);



        return view('cart.view', compact('itens', 'url', 'itemCount', 'filteredPopups'));
    }

    public function checkout()
    {
        $userID = Auth::id();
        $business_id = request()->session()->get('user');
        // Criar logina para validar se o usuário esta logado
        $itens = DummyCart::where('usuario_id', $userID)->get()->toArray();
        $url = config('constants.URL_IMAGES');

        $itemCount = count($itens);

        return view('cart.checkout', compact('itens', 'url', 'itemCount'));
    }

    public function removeItenCart(Request $request)
    {
        // Remover o item do carrinho
        \Cart::remove($request->id);

        // Remover o item associado na tabela DummyCart
        DummyCart::where('id_produto', $request->id)->delete();

        return redirect()->route('cart.view');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $data = $request->data;
        $quantidade = (int)$data['quantidade'];

        $dummyCart = DummyCart::findOrFail($data['id_dummy_cart']);
        $dummyCart->update(['quantity' => $quantidade]);

        return back()->with('success', 'Atualizado com sucesso!');
    }

    public function teste(Request $request, Cart $cart)
    {
        // Validação dos dados
        $validated = $request->validate([
            'data.id_dummy_cart' => 'required|exists:dummy_carts,id',
            'data.quantidade' => 'required|integer|min=1',
        ]);

        // Obtendo os dados validados
        $data = $validated['data'];
        $quantidade = (int)$data['quantidade'];

        // Encontrando e atualizando o DummyCart
        $dummyCart = DummyCart::findOrFail($data['id_dummy_cart']);
        $dummyCart->update(['quantity' => $quantidade]);

        // Redirecionando ou retornando uma resposta adequada
        return redirect()->route('cart.view')->with('success', 'Quantidade atualizada com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
