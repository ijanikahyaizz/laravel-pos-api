<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // create Product
    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'code'=>'required|string',
            'price'=>'required|integer',
        ]);

       // Debug console auth data
    // dd(auth()->user()->name);





        $product = Product::create([
            'name'=>$request->name,
            'code'=>$request->code,
            'price'=>$request->price,
            'user_id'=>auth()->user()->id,
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'product created',
            'data'=>$product
        ],201);
    }

    // get all product
    public function index()
    {
        $products = Product::where('user_id',auth()->user()->id)->get();

        return response()->json([
            'status'=>'success',
            'message'=>'product list',
            'data'=>$products
        ],200);
    }

    // get product by id
    public function show($id)
    {
        $product = Product::where('user_id',auth()->user()->id)->where('id',$id)->first();

        if ($product) {
            return response()->json([
                'status'=>'success',
                'message'=>'product detail',
                'data'=>$product
            ],200);
        } else {
            return response()->json([
                'status'=>'failed',
                'message'=>'product not found',
            ],404);
        }
    }

    // update product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string',
            'code'=>'required|string',
            'price'=>'required|integer',
        ]);

        $product = Product::where('user_id',auth()->user()->id)->where('id',$id)->first();

        if ($product) {
            $product->update([
                'name'=>$request->name,
                'code'=>$request->code,
                'price'=>$request->price,
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'product updated',
                'data'=>$product
            ],200);
        } else {
            return response()->json([
                'status'=>'failed',
                'message'=>'product not found',
            ],404);
        }
    }

    // delete product
    public function delete($id)
    {
        $product = Product::where('user_id',auth()->user()->id)->where('id',$id)->first();



        if ($product) {
            $product->delete();

            return response()->json([
                'status'=>'success',
                'message'=>'product deleted',
            ],200);
        } else {
            return response()->json([
                'status'=>'failed',
                'message'=>'product not found',
            ],404);
        }
    }

    // get all product
    public function all()
    {
        $products = Product::all();

        return response()->json([
            'status'=>'success',
            'message'=>'product list',
            'data'=>$products
        ],200);
    }
}
