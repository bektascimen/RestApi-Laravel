<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function index(Request $request)
    {
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 10;

        $qb = Product::query();
        if ($request->has('q'))
            $qb->where('name', 'like', '%' . $request->query('q') . '%');

        if ($request->has('sortBy'))
            $qb->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));

        $data = $qb->offset($offset)->limit($limit)->get();
        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $products = Product::create($input);

        return response([
            'data' => $products,
            'message' => 'Ürün eklendi.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product)
            return response($product, 200);
        else
            return response(['message' => 'Ürün bulunamadı.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $product->update($input);

        return response([
            'data' => $product,
            'message' => 'Ürün Bilgileri Güncellendi.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response([
            'message' => 'Ürün silindi.'
        ], 200);
    }
}
