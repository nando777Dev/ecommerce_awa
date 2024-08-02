<?php

return[

    'asset_version'=> 77,


    // id para recuperar os dados e configurações do ecommerce
    'business_id' =>  env('BUSINESS_ID_ECOMMERCE'),

    /***
       url para acessar as imagens do carrossel
     ***/
    //'url_carrossel'=> "https://app.contetecnologia.com.br/uploads/img/carrossel/",

    'url_carrossel'=> "http://127.0.0.1:8000/uploads/img/carrossel/",

    /***
        -- fim --
     ***/

    /***
      url das imagens de produtos
    ***/
    //'url_img_produto' => "https://app.contetecnologia.com.br/",
    'url_img_produto' => "http://127.0.0.1:8000",
    /***
        -- fim --
     ***/

    /****
        URL DAS IMAGENS DE DETALHES DE PRODUTO
     ***/
        //'URL_IMAGES' => "https://app.contetecnologia.com.br/uploads/img/";
        'URL_IMAGES' => "http://127.0.0.1:8000/uploads/img/",

    /***
    -- fim --
     ***/

    //url para acessar as imagens de destaque do ecommerce
    'url_config_imgs' => "https://app.contetecnologia.com.br/uploads/ecommerce_destaque",



    //url para acessar as fotos de destaque do ecommerce no localhost
    'url_img_local_host'=> "http://127.0.0.1:8000/uploads/ecommerce_destaque/",


    //url para favicon
    //'url_favicon' => "https://app.contetecnologia.com.br/uploads/ecommerce_fav/",
       'url_favicon'=> "http://127.0.0.1:8000/uploads/ecommerce_fav/",


    //url para logo

    //'url_logo' => "https://app.contetecnologia.com.br/uploads/ecommerce_logo/",
    'url_logo'=> "http://127.0.0.1:8000/uploads/ecommerce_logos/",

];
