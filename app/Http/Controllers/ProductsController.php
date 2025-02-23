<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ProductsController extends Controller
{
    //
    public function index(){
        return view('products.index');
    }
}
