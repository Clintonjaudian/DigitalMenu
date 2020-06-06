<?php

namespace App\Http\Controllers\dashboard1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\UpperLeftMenu1;
use App\model\UpperRightMenu1;
use App\model\LowerLeftMenu1;
use App\model\LowerRightMenu1;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $upper_left_data = UpperLeftMenu1::where('status', 1)->get();
        $upper_right_data = UpperRightMenu1::where('status', 1)->get();

        $lower_left_data = LowerLeftMenu1::where('status', 1)->first();
        $lower_right_data = LowerRightMenu1::where('status', 1)->first();

        return view('dashboard1.menu')->with([
            'upper_left_data' => $upper_left_data,
            'upper_right_data' => $upper_right_data,
            'lower_left_data' => $lower_left_data,
            'lower_right_data' => $lower_right_data
        ]);
    }
}
