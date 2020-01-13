<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;

use Validator;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find($request->user_id);

        $wishlists = $user->wishlist;

        return response()->json([
            'message' => 'success',
            'data' => $wishlists,
            'code' => 200
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wishlists = collect(json_decode($request->getContent()));
        $wishlists = $wishlists->pluck('id');
        $user = User::find($request->user()->id);

        $user->wishlist()->sync($wishlists);

        return response()->json([
            'message' => 'Success adding to wishlist',
            'data' => null,
            'code' => 200
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'user_id' => 'required'
        ]);

        $user = User::find($request->user_id);

        $product_id = $request->product_id;

        $user->wishlist()->detach($product_id);

        return response()->json([
            'message' => 'Success removing from wishlist',
            'data' => null,
            'code' => 200
        ], 200);
    }
}
