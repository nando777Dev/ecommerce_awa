<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $business_id = config('constants.business_id');

        $perPage = 4;

        $config = DB::table('config_text_about_us_in_ecommerces')
            ->where('business_id', $business_id)
            ->where('custom_main', '!=', 1)
            ->paginate($perPage);

        $config_text_main = DB::table('config_text_about_us_in_ecommerces')
            ->where('business_id', $business_id)
            ->where('custom_main', 1)
            ->first();


        $url_img = config('constants.url_img_local_host');
        //dd($config, $url_img);

        return view('about-us.about-us',
            ['config'=> $config,
             'config_text_main'=>$config_text_main,
             'url_img' => $url_img,
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
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        //
    }
}
