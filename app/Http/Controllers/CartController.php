<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cartList()
    {

        // Criar logina para validar se o usuário esta logado
        $itens = \Cart::getContent();
        $url = config('constants.URL_IMAGES');

        return view('cart.index', compact('itens', 'url'));
    }

    public function cartAdd(Request $request)
    {

        // Criar logina para validar se o usuário esta logado

        \Cart::add([
            'id'=> $request->id_produto,
            'name'=> $request->nome_produto,
            'price'=> $request->price,
            'quantity'=>   $request->quantidade,
            'attributes'=> array(
                'image'=> $request->img,
            )
        ]);

        return redirect()->route('cart.list');
    }

    public function removeItenCart(Request $request)
    {
        \Cart::remove($request->id);

        return redirect()->route('cart.list');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
