<?php

namespace App\Http\Controllers\Dashboard2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LowerLeft;
use App\Model\LowerRight;
use App\Model\RightSide;
use App\model\RightSideAddon;
use App\Model\Upper;

class MenuDashboard extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $right_side_data = RightSide::select('id', 'product_image', 'classification', 'price_tag')
            ->where('status', 1)->get();

            return response()->json(['right_side_data' => $right_side_data]);
        }

        $upper_data = Upper::where('status', 1)->get();

        $lower_left_data = LowerLeft::where('status', 1)->first();
    
        $lower_inner_data = LowerRight::where('status', 1)->first();

        return view('dashboard2.menu')->with([
            'upper_data' => $upper_data,
            'lower_left_data' => $lower_left_data,
            'lower_inner_data' => $lower_inner_data
        ]);
    }

    public function addon_data(Request $request)
    {
       if($request->ajax())
       {
            $id = $request->id;

            $addon_data = RightSideAddon::select('add_on', 'pcs')
            ->where([
                'right_side_id' => $id,
                'status' => 1
            ])->get();

            return response()->json(['addon_data' => $addon_data]);
       }
    }
}
