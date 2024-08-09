<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store(Request $request)
    {
        $product = new Product();
        $this->fillProduct($product,$request);
        if ($request->hasFile('image')) {
            $product->image = $this->storeImage($request->file('image'));
        }
        $product->save();
        return $product;
    }

    public function update(Request $request,Product $product)
    {
        $this->fillProduct($product,$request);
        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
            $product->image = $this->storeImage($request->file('image'));
        }

        $product->save();
        return $product;
    }

    private function fillProduct(Product $product, Request $request)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
    }


    private function storeImage($image)
    {
        return $image->store('images', 'public');
    }
}
