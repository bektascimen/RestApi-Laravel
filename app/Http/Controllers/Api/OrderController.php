<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class OrderController extends Controller
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

        $qb = Order::query()->with('products', 'users');
        if ($request->has('q'))
            $qb->where('orderCode', 'like', '%' . $request->query('q') . '%');

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

        $order = Order::create($input);

        return response([
            'data' => $order,
            'message' => 'Sipariş eklendi.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        $orders = Order::find($order);

        if ($orders)
            return response($orders, 200);
        else
            return response(['message' => 'Sipariş bulunamadı.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        $dt = new Carbon();

        $input = $request->all();

        if ($dt<$order->shippingDate){
            $order->update($input);

            return response([
                'data' => $order,
                'message' => 'Sipariş bilgileri güncellendi.'
            ], 200);
        }else{
            return response([
                'data' => $order,
                'message' => 'Siparişin tarihin geçtiği için güncellenemedi.'
            ], 200);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     * @throws Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response([
            'message' => 'Sipariş silindi.'
        ], 200);
    }
}
