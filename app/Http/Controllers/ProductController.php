<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use App\Utils\ProdutoUtil;
use Illuminate\Http\Request;
use App\Models\OrdesEcommerce;
use App\Models\BusinessLocation;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;
use App\Models\ProdutosPedidoEcommerce;

class ProductController extends Controller
{

    private $produtoUtil;


    public function __construct(ProdutoUtil $produtoUtil)
    {
        $this->produtoUtil = $produtoUtil;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $userID = Auth::id();

        $business_id = config('constants.business_id');

        $business_details  = Business::where('id', $business_id)->first();

        $business_location = BusinessLocation::where('business_id', $business_id)->first();


        $perPage = 12;

        $query = Product::join('variations as v', 'v.product_id', 'products.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->where('products.business_id', $business_id)
            ->where('vld.location_id', $business_location->id)
            ->where('products.ecommerce', 1)
            ->select(
                'v.default_sell_price as price',
                'v.id as variation_id',
                'products.name as name_produto',
                'products.id as id_produto',
                'products.novo',
                'products.image',
                'products.destaque',
                'products.altura',
                'products.largura',
                'products.comprimento',
                'products.altura',
                'products.product_description as description',
                'vld.qty_available as stock',
            );



        // Filtros de categoria, marca e preço
        if ($request->has('categoria')) {
            $categoria_id = $request->input('categoria');
            $query->where('products.category_id', $categoria_id);
        }
        if ($request->has('collection')) {
            $collection_id = $request->input('collection');
            $query->where('products.collection_id', $collection_id);
        }

        if ($request->has('marca')) {
            $marca_id = $request->input('marca');
            $query->where('products.brand_id', $marca_id);
        }

        if ($request->has('price')) {
            $price = $request->input('price');
            // Lógica para filtrar por preço
        }

        // Mapeamento de ordenação
        $sortOptions = [
            'price_desc' => ['v.default_sell_price', 'desc'],
            'price_asc' => ['v.default_sell_price', 'asc'],
            'name_asc' => ['products.name', 'asc']
        ];

        // Aplica a ordenação com base no parâmetro 'sort'
        $sort = $request->get('sort', '');
        if (array_key_exists($sort, $sortOptions)) {
            $query->orderBy($sortOptions[$sort][0], $sortOptions[$sort][1]);
        }

        $products = $query->paginate($perPage);

        $categorias = Category::where('business_id', $business_id)
            ->where('ecommerce', 1)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $marcas = Brands::where('business_id', $business_id)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $url_img = config('constants.URL_IMAGES');

        /* dd($products);
        die; */

        return view('product.index')->with(compact('products', 'url_img', 'categorias', 'marcas'));
    }

    public function destaques(Request $request)
    {
        $business_id = config('constants.business_id');

        $business_details  = Business::where('id', $business_id)->first();

        $business_location = BusinessLocation::where('business_id', $business_id)->first();
        $perPage = 12;

        $query = Product::join('variations as v', 'v.product_id', 'products.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->where('products.business_id', $business_id)
            ->where('vld.location_id', $business_location->id)
            ->where('products.ecommerce', 1)
            ->where('products.destaque', 1)
            ->select(
                'v.default_sell_price as price',
                'v.id as variation_id',
                'products.name as name_produto',
                'products.id as id_produto',
                'products.novo',
                'products.altura',
                'products.largura',
                'products.comprimento',
                'products.altura',
                'products.image',
                'products.destaque',
                'products.product_description as description',
                'vld.qty_available as stock',
            );

        // Filtros de categoria, marca e preço
        if ($request->has('categoria')) {
            $categoria_id = $request->input('categoria');
            $query->where('products.category_id', $categoria_id);
        }

        if ($request->has('marca')) {
            $marca_id = $request->input('marca');
            $query->where('products.brand_id', $marca_id);
        }

        if ($request->has('price')) {
            $price = $request->input('price');
            // Lógica para filtrar por preço
        }

        // Mapeamento de ordenação
        $sortOptions = [
            'price_desc' => ['v.default_sell_price', 'desc'],
            'price_asc' => ['v.default_sell_price', 'asc'],
            'name_asc' => ['products.name', 'asc']
        ];

        // Aplica a ordenação com base no parâmetro 'sort'
        $sort = $request->get('sort', '');
        if (array_key_exists($sort, $sortOptions)) {
            $query->orderBy($sortOptions[$sort][0], $sortOptions[$sort][1]);
        }

        $products = $query->paginate($perPage);

        $categorias = Category::where('business_id', $business_id)
            ->where('ecommerce', 1)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $marcas = Brands::where('business_id', $business_id)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $url_img = config('constants.URL_IMAGES');

        return view('product.destaques')->with(compact('products', 'url_img', 'categorias', 'marcas'));
    }

    public function novos(Request $request)
    {
        $business_id = config('constants.business_id');

        $business_details  = Business::where('id', $business_id)->first();

        $business_location = BusinessLocation::where('business_id', $business_id)->first();
        $perPage = 12;

        $query = Product::join('variations as v', 'v.product_id', 'products.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->where('products.business_id', $business_id)
            ->where('vld.location_id', $business_location->id)
            ->where('products.ecommerce', 1)
            ->where('products.novo', 1)
            ->select(
                'v.default_sell_price as price',
                'v.id as variation_id',
                'products.name as name_produto',
                'products.id as id_produto',
                'products.novo',
                'products.altura',
                'products.largura',
                'products.comprimento',
                'products.altura',
                'products.image',
                'products.destaque',
                'products.product_description as description',
                'vld.qty_available as stock',
            );

        // Filtros de categoria, marca e preço
        if ($request->has('categoria')) {
            $categoria_id = $request->input('categoria');
            $query->where('products.category_id', $categoria_id);
        }

        if ($request->has('marca')) {
            $marca_id = $request->input('marca');
            $query->where('products.brand_id', $marca_id);
        }

        if ($request->has('price')) {
            $price = $request->input('price');
            // Lógica para filtrar por preço
        }

        // Mapeamento de ordenação
        $sortOptions = [
            'price_desc' => ['v.default_sell_price', 'desc'],
            'price_asc' => ['v.default_sell_price', 'asc'],
            'name_asc' => ['products.name', 'asc']
        ];

        // Aplica a ordenação com base no parâmetro 'sort'
        $sort = $request->get('sort', '');
        if (array_key_exists($sort, $sortOptions)) {
            $query->orderBy($sortOptions[$sort][0], $sortOptions[$sort][1]);
        }

        $products = $query->paginate($perPage);

        $categorias = Category::where('business_id', $business_id)
            ->where('ecommerce', 1)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $marcas = Brands::where('business_id', $business_id)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $url_img = config('constants.URL_IMAGES');

        return view('product.novos')->with(compact('products', 'url_img', 'categorias', 'marcas'));
    }


    public function productsCollection(Request $request)
    {
        $collection_id = $request->input('collection');
        $business_id = config('constants.business_id');
        $config = \App\Models\CollectionsEcommerce::config($business_id, $collection_id);
        $perPage = 12;

        $query = Product::join('variations as v', 'v.product_id', 'products.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->where('products.business_id', $business_id)
            ->where('vld.location_id', 40)
            ->select(
                'v.default_sell_price as price',
                'v.id as variation_id',
                'products.name as name_produto',
                'products.id as id_produto',
                'products.novo',
                'products.image',
                'products.destaque',
                'products.product_description as description',
                'vld.qty_available as stock',
            );

        // Collection
        if ($request->has('collection')) {
            $collection_id = $request->input('collection');
            $query->where('products.collection_id', $collection_id);
        }


        // Mapeamento de ordenação
        $sortOptions = [
            'price_desc' => ['v.default_sell_price', 'desc'],
            'price_asc' => ['v.default_sell_price', 'asc'],
            'name_asc' => ['products.name', 'asc']
        ];

        // Aplica a ordenação com base no parâmetro 'sort'
        $sort = $request->get('sort', '');
        if (array_key_exists($sort, $sortOptions)) {
            $query->orderBy($sortOptions[$sort][0], $sortOptions[$sort][1]);
        }

        $products = $query->paginate($perPage);

        $categorias = Category::where('business_id', $business_id)
            ->where('ecommerce', 1)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $marcas = Brands::where('business_id', $business_id)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $url_img = config('constants.URL_IMAGES');
        $url_config = config('constants.url_img_local_host');


        return view('product.collection')->with(compact('products', 'url_img', 'categorias', 'marcas', 'config', 'url_config'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'product create';
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
    public function show(string $id)
    {
        $business_id = config('constants.business_id');

        $productDetails = Product::join('variations as v', 'v.product_id', 'products.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->join('produto_imagems as pimg', 'pimg.produto_id', 'products.id')
            ->where('products.id', $id)
            ->where('products.business_id', $business_id)
            ->select(
                'v.default_sell_price as price',
                'products.name as name_produto',
                'products.id as id_produto',
                'products.novo',
                'products.destaque',
                'products.product_description as description',
                'vld.qty_available as stock',
                'pimg.img',
                'pimg.produto_id',
                'products.altura',
                'products.largura',
                'products.comprimento'
            )
            ->get();

        if ($productDetails->isEmpty()) {
            throw new CustomException("Nenhum produto encontrado.", 404);
        }

        $productDetailsArray = $productDetails->toArray();
        $groupedProductDetails = [];

        foreach ($productDetailsArray as $detail) {
            $productId = $detail['id_produto'];
            if (!isset($groupedProductDetails[$productId])) {
                // Inicializa a entrada do produto com detalhes comuns
                $groupedProductDetails[$productId] = [
                    'price' => $detail['price'],
                    'nome_produto' => $detail['name_produto'],
                    'description' => $detail['description'],
                    'id_produto' => $detail['id_produto'],
                    'novo' => $detail['novo'],
                    'destaque' => $detail['destaque'],
                    'altura' => $detail['altura'],
                    'largura' => $detail['largura'],
                    'comprimento' => $detail['comprimento'],
                    'stock' => $detail['stock'],
                    'images' => []
                ];
            }

            // Adiciona a imagem ao array de imagens do produto se ainda não existir e se houver menos de 4 imagens
            if (!in_array($detail['img'], $groupedProductDetails[$productId]['images']) && count($groupedProductDetails[$productId]['images']) < 4) {
                $groupedProductDetails[$productId]['images'][] = $detail['img'];
            }
        }

        // Converte o array associativo em um array indexado numericamente
        $groupedProductDetails = array_values($groupedProductDetails);

        $variations = $this->produtoUtil->getVariations($id, $business_id);
        $url_img = config('constants.URL_IMAGES');

        return view('product.product_details', [
            'id_produto' => $id,
            'variations' => $variations,
            'productDetails' => $groupedProductDetails,
            'url' => $url_img
        ]);
    }

    public function showModal($id)
    {
        $pedido = OrdesEcommerce::find($id);
        $url = config('constants.URL_IMAGES');

        $itens = ProdutosPedidoEcommerce::join('products as p', 'p.id', 'produtos_pedido_ecommerces.id_produto')
            ->join('variations as v', 'v.product_id', 'p.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->where('id_pedido', $pedido->id_dunning_asaas)
            ->select('v.default_sell_price as price',
                'v.id as variation_id',
                'p.name as nome',
                'p.id as id_produto',
                'p.novo',
                'p.image',
                'p.destaque',
                'product_description as description',
                'vld.qty_available as stock')
            ->get()
            ->toArray();

        if (!$pedido) {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }

        return view('product.partials.product_details_modal_content', compact('pedido', 'itens', 'url'));
    }

    public function search(Request $request)
    {

        $cityName = $request->input('city_name');

        $cities = City::where('nome', 'like', '%' . $cityName . '%')->get(['id', 'nome', 'uf']);

        if ($cities->isNotEmpty()) {
            $temp = [];
            foreach($cities as $c){
                $temp[] = [
                    'id' => $c->id,
                    'nome' => $c->nome . " (" . $c->uf . ")"
                ];
            }
            return response()->json(['cities' => $temp]);
        }

        return response()->json(['cities' => []]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
