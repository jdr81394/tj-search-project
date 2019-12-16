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
    //
    public function index(Request $request) {
        if ($request->has('action')) {
            switch($request->action) {
                case 'basicSearch':
                    return $this->getBasicSearch($request);
                    break;
            }
        }

            // $result = DB::table('items')->select('*')->where('name', 'LIKE','%'.'new'.'%')->get();

            // return response()->json($result,200);
    }


    private function getBasicSearch($request) {
        try {

            $name = $request->name;

            $result = DB::table('items')->select('*')->where('name', 'LIKE','%'.$name.'%')->get();

            return response()->json($result,200);

        } catch(Exception $e) {

        }
    }

}
