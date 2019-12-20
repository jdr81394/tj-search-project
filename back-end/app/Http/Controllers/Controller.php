<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use DB;
use Exception;

class Controller extends BaseController
{
    // Jake - Tested
    public function index(Request $request) {
        if ($request->has('action')) {
            switch($request->action) {
                case 'basicSearch':
                    return $this->getBasicSearch($request);
                    break;
            }
        }

        // return $request;

            // $result = DB::table('items')->select('*')->where('name', 'LIKE','%'.'item'.'%')->limit(3)->get();

            // return response()->json($result,200);
    }


    // This is for homepage's basic search
    // Jake - Tested
    private function getBasicSearch($request) {
        try {

            $name = $request->name;

            $result = DB::table('items')->select('*')->where('name', 'LIKE','%'.$name.'%')->limit(15)->get();

            return response()->json($result,200);

        } catch(Exception $e) {

        }
    }



    // This update function will be sending the items id number to a user's cart which will be an array 
    // Jake - Tested
    public function update(Request $request) {
        // if ($request->has('action')) {
        //     switch ($request->action) {
        //         case 'addToCart':
        //             return $this->addToCart($request);
        //         break;
        //         case 'removeFromCart':
        //             return $this->removeFromCart($request);
        //         break;
        //     }
        // }
        if ($request->has('action')) {
            switch($request->action) {
                case 'addToCart':
                    return $this->addToCart($request);
                break;
                case 'removeFromCart':
                    return $this->removeFromCart($request);
                break;
            }
        }
    }

    private function addToCart($request) {
        try {

            // Item that was selected to be added
            $add_to_cart = $request->add_to_cart;
            $user_id = $request->user_id;
            // append item's id # to users' cart
            $fetch_cart= DB::table('users')->select('cart')->where('id', '=', $user_id)->first();
            $cart = json_decode($fetch_cart->cart);

            // Ensure that the add_to_cart is an integer. If string, cast to integer.
            if (gettype($add_to_cart) == 'string') {
                $add_to_cart = (int)$add_to_cart;
                
            }
            // Push the number of the item into the cart.
            array_push($cart, $add_to_cart);

            // Update the cart.
            $updated_cart = DB::table('users')->select('cart')->where('id', '=', $user_id)->update(['cart' => $cart]);

            return response()->json_encode($updated_cart, 200);

        } catch(Exception $e) {

        }
    }

    private function removeFromCart($request) {
        try{
            // return 'in remove cart';
            $remove_from_cart = $request->remove_from_cart;
            $user_id = $request->user_id;

            //Get cart
            $fetch_cart = DB::table('users')->select('cart')->where('id','=',$user_id)->first();
            $cart = json_decode($fetch_cart->cart);
            // $key = array_search($remove_from_cart, $cart_to_alter);

            // $new_cart = unset($cart_to_alter[$key]);

            // Find position of item to be removed in array, and unset it. 
            // return json_encode($cart);

            $key = array_search($remove_from_cart, $cart);
            array_splice($cart, $key, 1);            
           
            $updated_cart = DB::table('users')->select('cart')->where('id', '=', $user_id)->update(['cart' => $cart]);

            return response()->json_encode("The item was successfully removed from your cart.", 200);

        } catch(Exception $e) {

        }
    }




}
