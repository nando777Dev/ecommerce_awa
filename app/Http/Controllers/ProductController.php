<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use App\Utils\ProdutoUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{



    public function __construct(ProdutoUtil $produtoUtil)
    {
        $this->produtoUtil = $produtoUtil;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $business_id = config('constants.business_id');
        $perPage = 12;

        $query = Product::join('variations as v', 'v.product_id', 'products.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->where('products.business_id', $business_id)
            ->where('vld.location_id', 40)
            ->where('products.ecommerce', 1)
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

        return view('product.index')->with(compact('products', 'url_img', 'categorias', 'marcas'));
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

        //$productDetails = $this->produtoUtil->getProductDetails($id, $business_id );

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
                'pimg.produto_id'
            )
            ->get()
            ->toArray();

        $groupedProductDetails = [];

        foreach ($productDetails as $detail) {
            $productId = $detail['id_produto'];
            if (!isset($groupedProductDetails[$productId])) {
                // Initialize the product entry with common details
                $groupedProductDetails[$productId] = [
                    'price' => $detail['price'],
                    'nome_produto' => $detail['name_produto'],
                    'description' => $detail['description'],
                    'id_produto' => $detail['id_produto'],
                    'novo' => $detail['novo'],
                    'destaque' => $detail['destaque'],
                    'stock' => $detail['stock'],
                    'images' => [] // Initialize the images array
                ];
            }
            // Add the image to the product's images array if it doesn't already exist and if less than 4 images
            if (!in_array($detail['img'], $groupedProductDetails[$productId]['images']) && count($groupedProductDetails[$productId]['images']) < 4) {
                $groupedProductDetails[$productId]['images'][] = $detail['img'];
            }
        }

            // Convert the associative array to a numerically indexed array
        $groupedProductDetails = array_values($groupedProductDetails);

        $variations = $this->produtoUtil->getVariations($id, $business_id);

        $url_img = config('constants.URL_IMAGES');


      return view('product.product_details', [
          'id_produto'=>$id,
          'variations' => $variations,
          'productDetails'=> $groupedProductDetails,
          'url'=>$url_img
      ]);
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
