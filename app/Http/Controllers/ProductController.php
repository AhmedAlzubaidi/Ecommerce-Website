<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductOptionRequest;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::withRelationships()->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();

        foreach ($request->input('categories') as $categoryName) {
            $category = Category::where('name', $categoryName)->first();
            $category->attach($product);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $image->move('uploads/products/', $fileName);
            $product->image = $fileName;
        }

        if ($request->has('discount')) {
            $discount = $request->input('discount');
            $product->discount = $discount;
            $product->on_sale  = $discount > 0;
        } else {
            $product->on_sale = false;
        }

        $product->name     = $request->input('name');
        $product->price    = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->save();

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $result = Auth::check() ? 'true' : 'false';
        Log::info('user object: ' . $result);
        return $product->loadAll();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\ProductRequest  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->name     = $request->input('name');
        $product->price    = $request->input('price');
        $product->on_sale  = $request->input('on_sale');
        $product->quantity = $request->input('quantity');
        
        if ($request->has('discount')) {
            $discount          = $request->input('discount');
            $product->discount = $discount;
            $product->on_sale  = $discount > 0;
        } else {
            $product->discount = null;
            $product->on_sale = false;
        }

        $product->save();

        return $product->loadAll();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $categories = $product->categories();
        $options    = $product->productOptions();

        foreach ($categories as $category) {
            $category->detach($product);
        }

        foreach ($options as $option) {
            $option->delete();
        }

        return $product->delete();
    }

    public function storeProductOption(ProductOptionRequest $request)
    {
        $productOption = new ProductOption();
        $productOption->product_id = $request->input('product_id');
        $productOption->key = $request->input('key');
        $productOption->value = $request->input('value');
        $productOption->save();

        return Product::where('id', $request->input('product_id'))->first()->productOptions();
    }

    public function updateProductOption(ProductOption $productOption, ProductOptionRequest $request)
    {
        $productOption->key = $request->input('key');
        $productOption->value = $request->input('value');
        $productOption->save();
        
        return $productOption;
    }

    public function destroyProductOption(ProductOption $productOption)
    {
        return $productOption->delete();
    }
}
