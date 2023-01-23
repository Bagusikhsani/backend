<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    public function all(request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('id');
        $show_product = $request->input('id');

        if($id)
        {
            $product = ProductCategory::with(['products'])->find($id);

            if($product){
                return ResponseFormatter::success(
                    $product,
                    'Data kategori berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    $product,
                    'Data kategori tidak ada'
                );
            }
        }

        
        $category = ProductCategory::query();

        if($name){
            $category->where('name', 'like', '%' . $name . '%');
        }

        if($show_product) {
            $category->with('products');
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data kategori berhasil diambil'
        );
    }
}
