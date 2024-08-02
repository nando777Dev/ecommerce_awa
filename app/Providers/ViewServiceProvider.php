<?php

namespace App\Providers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\CollectionsEcommerce;
use App\Models\DummyCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $business_id = config('constants.business_id');
            $userID = Auth::id();

            $itens = DummyCart::where('usuario_id', $userID)->get()->toArray();
            $itemCount = count($itens);

            //Soma dos itens do carrinho
            $quantitySum = DummyCart::where('usuario_id', $userID)->sum('quantity');

            //soma total do valor do carrinho
            $totalCartSum = DummyCart::where('usuario_id', $userID)
                ->selectRaw('SUM(price * quantity) as total')
                ->value('total');


            //Recupera todas as marcas
            $brands = Brands::where('business_id', $business_id)->limit(3)->get()->toArray();

            //Recupera todas as coleções
            $collections = CollectionsEcommerce::forDropdown($business_id);

            //Recupera toda as categorias
            $categorias = Category::where('business_id', $business_id)
                ->where('ecommerce', 1)
                ->where('destaque', 1)
                ->limit(3)
                ->get()
                ->toArray();


            //Recupera a configuração do POP-up
            $config_popup = DB::table('config_ecommerce_popups')
                ->where('business_id', $business_id)
                ->get()
                ->toArray();

            // Recupera os dados do footer
            $footer_details = DB::table('config_ecommerces')
                ->select('email', 'telefone', 'fav_icon', DB::raw("CONCAT(rua, ', ', numero, ', ', cidade, ', ', uf, ', ', cep) as endereco"))
                ->where('business_id', $business_id)
                ->get()
                ->first();



            // Recupera o fav_icon
            $images  = DB::table('config_ecommerces')
                ->select('fav_icon', 'logo')
                ->where('business_id', $business_id)
                ->first();
            // Recupera a URL fav_icon
            $url_ecommerce_fav = config('constants.url_favicon');

            // Recupera a URL Logo marca
            $url_ecommerce_logo = config('constants.url_logo');


            //Concatena url do fav_icon com o fav_icon
            $url_favicon = $url_ecommerce_fav . $images->fav_icon;

            //Concatena url do lgo com o logo
            $url_logo = $url_ecommerce_logo . $images->logo;

            $view->with([
                'collections' => $collections,
                'config_popup' => $config_popup,
                'categorias'=> $categorias,
                'footer_details' => $footer_details,
                'url_favicon'=> $url_favicon,
                'url_logo'=>$url_logo,
                'itemCount'=>$quantitySum,
                'totalCart'=>$totalCartSum

            ]);
        });
    }
}
