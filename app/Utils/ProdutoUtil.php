<?php

namespace App\Utils;

use App\Models\Product;
use App\Models\VariationTemplate;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;

class ProdutoUtil extends Util
{

    public function getConfigEcommerce($business_id)
    {
        $config_home = DB::table('config_ecommerces')
            ->where('business_id', $business_id)
            ->get();

        if ($config_home->isEmpty()) {
            throw new CustomException("Nenhuma configuração cadastrada ainda");
        }

        return $config_home->toArray();
    }

    public function getConfigCarrosselEcommerce($business_id)
        {

            $config_carrossel = DB::table('carrossel_ecommerces')
                ->where('business_id', $business_id)
                ->get();

                if ($config_carrossel->isEmpty()) {
                    throw new CustomException("Nenhuma configuração cadastrada");
                }

            return $config_carrossel->toArray();

        }

    public function getNewProducts($business_id)
        {
            $product_details = [];
            $products = Product::where('business_id', $business_id)
                ->where('ecommerce', 1)
                ->where('novo', 1)
                ->with(['brand', 'unit', 'category', 'variations', 'variations.product_variation', 'variations.group_prices', 'variations.variation_location_details', 'variations.media', 'product_locations'])
                ->take(9) // Limita o número de resultados para 4
                ->get();

                if ($products->isEmpty()) {
                    throw new CustomException("Nenhum produto cadastrado ainda");
                }


            foreach ($products as $product) {

                $qty_available = null;
                $image_url = null;
                $default_sell_price = null;

                if ($product->variations->isNotEmpty()) {
                    $variation = $product->variations->first();

                    if ($variation->variation_location_details->isNotEmpty()) {
                        $qty_available = $variation->variation_location_details->first()->qty_available;
                    }

                    if ($variation->media->isNotEmpty()) {
                        $image_url = $variation->media->first()->display_url;

                        $url = "https://app.contetecnologia.com.br/";

                        //$url = config('constants.url_img_produto');


                        $image_url = str_replace("https://awadesign.com.br/", $url, $image_url);



                    }

                    if ($product->variations->isNotEmpty()) {
                        $default_sell_price = $variation->default_sell_price;
                    }
                }

                $product_details[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty_available' => $qty_available,
                    'default_sell_price' => $default_sell_price,
                    'image_url' => $image_url,
                    'novo'=> $product->novo,
                    'destaque'=> $product->destaque
                ];
            }

            
            return $product_details;

        }

    public function getDestaqueProducts($business_id)
    {

        $products = Product::where('business_id', $business_id)
            ->where('ecommerce', 1)
            ->where('destaque', 1)
            ->with(['brand', 'unit', 'category', 'variations', 'variations.product_variation', 'variations.group_prices', 'variations.variation_location_details', 'variations.media', 'product_locations'])
            ->take(4) // Limita o número de resultados para 4
            ->inRandomOrder()
            ->get();

            if ($products->isEmpty()) {
                throw new CustomException("Entre em contato com suporte pelo email: suporte@contetecnologia.com.br", 500);
            }

        foreach ($products as $product) {

            $qty_available = null;
            $image_url = null;
            $default_sell_price = null;

            if ($product->variations->isNotEmpty()) {
                $variation = $product->variations->first();

                if ($variation->variation_location_details->isNotEmpty()) {
                    $qty_available = $variation->variation_location_details->first()->qty_available;
                }

                if ($variation->media->isNotEmpty()) {
                    $image_url = $variation->media->first()->display_url;

                    //$url = "https://app.contetecnologia.com.br/";

                    $url = config('constants.url_img_produto');


                    $image_url = str_replace("https://awadesign.com.br/", $url, $image_url);



                }

                if ($product->variations->isNotEmpty()) {
                    $default_sell_price = $variation->default_sell_price;
                }
            }

            $product_details[] = [
                'id' => $product->id,
                'name' => $product->name,
                'qty_available' => $qty_available,
                'default_sell_price' => $default_sell_price,
                'image_url' => $image_url,
                'novo'=> $product->novo,
                'destaque'=> $product->destaque
            ];
        }
        //dd($product_details);

        return $product_details;

    }


    public function getRandomProduct($business_id)
    {
        // Seleciona um produto aleatório que atenda aos critérios especificados
        $product = Product::where('business_id', $business_id)
            ->where('ecommerce', 1)
            ->where('novo', 1)
            ->with([
                'brand',
                'unit',
                'category',
                'variations',
                'variations.product_variation',
                'variations.group_prices',
                'variations.variation_location_details',
                'variations.media',
                'product_locations'
            ])
            ->inRandomOrder()
            ->first();

        if (!$product) {
            throw new CustomException("Nenhum produto cadastrado ainda", 500);
        }

        $qty_available = null;
        $image_url = null;
        $default_sell_price = null;

        if ($product->variations->isNotEmpty()) {
            $variation = $product->variations->first();

            if ($variation->variation_location_details->isNotEmpty()) {
                $qty_available = $variation->variation_location_details->first()->qty_available;
            }

            if ($variation->media->isNotEmpty()) {
                $image_url = $variation->media->first()->display_url;

                $url = "https://app.contetecnologia.com.br/";
                //$url = config('constants.url_img_produto');
                $image_url = str_replace("https://awadesign.com.br/", $url, $image_url);
            }

            if ($product->variations->isNotEmpty()) {
                $default_sell_price = $variation->default_sell_price;
            }
        }

        $product_details = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'qty_available' => $qty_available,
            'default_sell_price' => $default_sell_price,
            'image_url' => $image_url,
            'novo'=> $product->novo,
            'destaque'=> $product->destaque
        ];

        return $product_details;
    }



    public function getProductDetails($id_produto, $business_id)
        {
       $product = Product::where('business_id', $business_id)
                ->with(['variations', 'variations.media', 'variations.variation_location_details'])
                ->findOrFail(1000);

                if ($product->isEmpty()) {
                    throw new CustomException("Produto não encontrado", 500);
                }

        $product_details = [];

        $qty_available = null;
        $default_sell_price = null;

        if ($product->variations->isNotEmpty()) {
            foreach ($product->variations as $variation) {
                if ($variation->variation_location_details->isNotEmpty()) {
                    $qty_available = $variation->variation_location_details->first()->qty_available;
                }

                if ($product->variations->isNotEmpty()) {
                    $default_sell_price = $variation->default_sell_price;
                }

                $images = [];
                if ($variation->media->isNotEmpty()) {
                    foreach ($variation->media as $media) {
                        $images[] = $media->display_url;
                    }
                }

                $product_details[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'variation_id' => $variation->id,
                    'variation_name' => $variation->name,
                    'qty_available' => $qty_available,
                    'default_sell_price' => $default_sell_price,
                    'images' => $images,
                    'novo' => $product->novo,
                    'destaque' => $product->destaque,
                    'type'=>$product->type
                ];
            }
        }

        //dd($product_details);

        return $product_details;
    }


   public function getVariations($id, $business_id)
        {


            $variations = Product::where('products.business_id', $business_id)
                ->where('products.id', $id)
                ->leftJoin('variations as v', 'products.id', 'v.product_id')
                ->join('variation_value_templates as vvt', 'vvt.id', 'v.variation_value_id')
                ->join('variation_templates as vt', 'vvt.variation_template_id', 'vt.id')
                ->select('vt.name as variation_name', 'vvt.name as variation_value', 'vvt.id as variation_ids', 'v.id as variation_id')
                ->get()
                ->toArray();

            $groupedVariations = [];

            foreach ($variations as $variation) {

                if (!isset($groupedVariations[$variation['variation_name']])) {
                    $groupedVariations[$variation['variation_name']] = [];
                }

                $groupedVariations[$variation['variation_name']][$variation['variation_id']] = $variation['variation_value'];
            }
            //dd($groupedVariations);
            return $groupedVariations;
        }






}
