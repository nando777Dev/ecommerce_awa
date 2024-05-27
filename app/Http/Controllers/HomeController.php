<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils\Util;
use App\Utils\ProdutoUtil;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */

    public function __construct(ProdutoUtil $produtoUtil)
    {
        $this->produtoUtil = $produtoUtil;

    }
    public function index()
    {
        $business_id = config('constants.business_id');

        $url_carrossel = config('constants.url_carrossel');



        // Configurações da pagina Home
        $config_home = $this->produtoUtil->getConfigEcommerce($business_id);

        $config_carrossel  = $this->produtoUtil->getConfigCarrosselEcommerce($business_id);


        //Lista de produtos adicionados recentemente (6)
        $product_details = $this->produtoUtil->getNewProducts($business_id);

        return view('home.index', [
                'config'=> $config_home,
                'product_details' => $product_details,
                'config_carrossel' => $config_carrossel,
                'url_carrossel' => $url_carrossel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
