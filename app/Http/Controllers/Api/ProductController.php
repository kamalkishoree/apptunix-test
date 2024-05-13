<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\ProductCreateRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->query('per_page', 5);
        $products = Product::orderBy("id","desc")->paginate($per_page);
        $next_page = $products->nextPageUrl();
        return response()->json(['products'=>$products,'next_page_url'=>$next_page],200);
    }


    public function create(ProductCreateRequest $request)
    {
        if($request->has('image'))
        {
            $image = $request->file('image');
            $image_name =  time().$image->getClientOriginalName();
            $image->move(public_path('image/products/'), $image_name);

        }
        else
        {
            return response()->json(['message'=>'Product image can not be empty'],422);
        }

        $product = Product::create(
            [
                'name'=> $request->input('name'),
                'description'=> $request->input('description'),
                'price'=> $request->input('price'),
                'image' => asset('image/products/').$image_name
            ]
          );
            if($product)
            {
                return response()->json(['message'=> 'Product saved Successfuly'],200);
            }
            else
            {
                return response()->json(['error'=> 'Product not saved '],0);
            }
    }

    public function view(Request $request, $id)
    {
        try{
        $product = Product::findOrFail($id);
        if($product)
        {
            return response()->json(['message'=>'Success','product'=> $product],200);
        }
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=>'Success','product'=> 'no data found with this product id'],200);
        }

    }


    public function edit(Request $request,$id)
    {
        $product_data=[];
      try{  $product = Product::findOrFail($id);
        if($product)
        {
            if($request->has('image'))
            {
                $image = $request->file('image');
                $image_name =  time().$image->getClientOriginalName();
                $image->move(public_path('image/products/'), $image_name);
                $product_data['image']=$image_name;
            }

            if($request->has('description'))
            {
                $product_data['description']=$request->description;
            }
            if($request->has('name'))
            {
                $product_data['name']=$request->name;
            }
            if($request->has('price'))
            {
                $product_data['price']=$request->price;
            }
           $update= $product->update($product_data);
           if($update)

           {
            return response()->json(['message'=> 'Product updated Successfuly'],200);

           }
           else
           {
            return response()->json(['message'=> 'Product has not been updated'],400);

           }
        }
    }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=>'Success','product'=> 'no data found with this product id'],200);
        }

    }

    public function delete(Request $request,$id)
    {
       try{ $product = Product::findOrFail($id);
        if($product)
        {
            $product->delete();
            return response()->json(['message'=> 'product deleted successfully'],400);
        }
         }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['message'=>'Success','product'=> 'no data found with this product id'],200);
        }

    }

}
