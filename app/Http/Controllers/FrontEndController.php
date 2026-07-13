<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class FrontEndController extends Controller
{
    public function homePage(Request $request){
        $products = Product::where('visibility', 1)->latest()->take(10)->get();
        $data = [
            'pageTitle'=>'SIPARI | Sistem Informasi Pasar Iwak Demak',
            'products'=>$products
        ];
        return view('front.pages.home',$data);
    }
}

