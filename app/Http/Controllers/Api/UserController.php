<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 10;

        $qb = User::query();
        if ($request->has('u'))
            $qb->where('name', 'like', '%' . $request->query('u') . '%');

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

        $order = User::create($input);

        return response([
            'data' => $order,
            'message' => 'Kullanıcı eklendi.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|ResponseFactory|Response
     */
    public function show(User $user)
    {
        $user = User::find($user);

        if ($user)
            return response($user, 200);
        else
            return response(['message' => 'Kullanıcı bulunamadı.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $user->update($input);

        return response([
            'data' => $user,
            'message' => 'Kullanıcı bilgileri güncellendi.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response([
            'message' => 'Kullanıcı silindi.'
        ], 200);
    }

    public function custom()
    {
        $users = User::all();
        return UserResource::collection($users);
    }
}
