<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionsEcommerce extends Model
{
    protected $fillable = [];

    public static function forDropdown($business_id)
    {
        $categories = CollectionsEcommerce::where('business_id', $business_id)
            ->limit(4)
            ->get();

        $dropdown =  $categories->pluck('name', 'id');

        return $dropdown;
    }

    public static  function config($business_id, $id)
    {
        $config  = CollectionsEcommerce::where('id', $id)
            ->where('business_id', $business_id)
            ->first();

        return $config;
    }
}
