<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $banners = Banner::where('is_active', true)->get();

        $modularBaths = Product::where('category_id', 1)->take(4)->get();
        $kupelElite = Product::where('category_id', 2)->where( 'subcategory_id', 4)->take(4)->get();
        $kupelComfort = Product::where('category_id', 2)->where( 'subcategory_id', 5)->take(4)->get();
        $kupelCorner = Product::where('category_id', 2)->where( 'subcategory_id', 6)->take(4)->get();
        $kupelStandart = Product::where('category_id', 2)->where( 'subcategory_id', 7)->take(4)->get();

        return view('home', [
            'banners' => $banners,
            'modularBaths' => $modularBaths,
            'kupelElite' => $kupelElite,
            'kupelComfort' => $kupelComfort,
            'kupelCorner' => $kupelCorner,
            'kupelStandart' => $kupelStandart,
        ]);
    }
}