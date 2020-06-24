<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use App\Model\Product;
use App\Model\User;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Database\Eloquent\Builder;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);

        $cart = $user->carts;

        return response()->json([
            'message' => 'success',
            'data' => $cart,
            'status' => 200,
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
        $carts = json_decode($request->getContent());

        $user = User::find($request->user()->id);

        foreach ($carts as $cart) {
            $user->carts()->syncWithoutDetaching([$cart->id => ['price' => $cart->price, 'quantity' => $cart->quantity]]);
        }

        return response()->json([
            'message' => 'success adding to cart',
            'data' => $user->carts,
            'status' => 200,
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
        $validate = Validator::validate($request->all(), [
            'product_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'something went wrong',
                'errors' => $validate->getMessageBag()->toArray(),
                'status' => 422
            ], 422);
        }

        $cart = new Cart;

        $cart->user_id = $request->user()->id;
        $cart->product_id = $request->product_id;
        $cart->price = $request->price;
        $cart->quantity = $request->quantity;

        $cart->save();

        return response()->json([
            'message' => 'success updating cart',
            'data' => null,
            'status' => 200,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartDelete = Cart::destroy($id);

        return response()->json([
            'message' => 'success deleting cart',
            'data' => null,
            'status' => 200,
        ], 200);
    }
}
