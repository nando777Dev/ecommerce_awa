<?php

namespace App\Http\Controllers;

use App\Models\Brands;
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

        $produtoAleatorio = $this->produtoUtil->getRandomProduct($business_id);


        // Configurações da pagina Home
        $config_home = $this->produtoUtil->getConfigEcommerce($business_id);

        $config_carrossel  = $this->produtoUtil->getConfigCarrosselEcommerce($business_id);


        //Lista de produtos adicionados recentemente (6)
        $product_details = $this->produtoUtil->getNewProducts($business_id);

        $product_destaque = $this->produtoUtil->getDestaqueProducts($business_id);

        $config_popup = DB::table('config_ecommerce_popups')
                ->where('business_id', $business_id)
                ->get()
                ->toArray();

                $popups = $config_popup;

                $filteredPopups = array_filter($popups, function($popup) {
                    return strpos($popup->page_popup, 'home') !== false;
                });

                $url_config_imgs = config('constants.url_img_local_host');

        return view('home.index', [
                'config'=> $config_home,
                'product_details' => $product_details,
                'config_carrossel' => $config_carrossel,
                'url_carrossel' => $url_carrossel,
                'produtoAleatorio'=> $produtoAleatorio,
                'produtoDestaque' => $product_destaque,
                'filteredPopups'=>$filteredPopups,
                'url_config_imgs'=>$url_config_imgs
        ]);
    }

    public function privacidade()
    {

        $business_id = config('constants.business_id');

        $url_carrossel = config('constants.url_carrossel');

        $produtoAleatorio = $this->produtoUtil->getRandomProduct($business_id);

        $config_home = DB::table('config_ecommerces')
            ->where('business_id', $business_id)
            ->first();

        //dd($config_home);

        // Configurações da pagina Home

        return view('home.privacidade', [
            'config_home' => $config_home,
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
