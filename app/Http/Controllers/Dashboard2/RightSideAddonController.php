<?php

namespace App\Http\Controllers\dashboard2;

use App\Http\Controllers\Controller;
use App\model\RightSideAddon;
use Illuminate\Http\Request;

class RightSideAddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request->ajax())
        {
            $right_side_id = $request->right_side_id;
            $add_on = $request->add_addon;
            $pcs = $request->add_pcs;

            $exist = RightSideAddon::where([
                'right_side_id' => $right_side_id,
                'add_on' => $add_on
            ])->first();

            if($exist)
            {
                return response()->json(['exist' => true]);
            }
            else
            {
                for($count = 0; $count < count($add_on); $count++)
                {
                $data = array(
                    'right_side_id' => $right_side_id,
                    'add_on' => ucwords($add_on[$count]),
                    'pcs' => $pcs[$count]
                );

                $insert_data[] = $data;
                }

                $store_addon = RightSideAddon::insert($insert_data);

                if($store_addon)
                {
                    return response()->json(['validator' => true]);
                }
                else
                {
                    return response()->json(['validator' => false]);
                }
            }
        }
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
        if(request()->ajax())
        {
           $data = RightSideAddon::find($id);

           return response()->json(['addon_data' => $data]);
        }
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
        if($request->ajax())
        {
            $update = RightSideAddon::find($id);
            $update->add_on = ucwords($request->edit_addon);
            $update->pcs = $request->edit_pcs;
            $update->status = $request->edit_addon_status;

            if($update->save())
            {
                return response()->json(['validator' => true]);
            }
            else
            {
                return response()->json(['validator' => false]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request()->ajax())
        {
            $destroy = RightSideAddon::destroy($id);

            if($destroy)
            {
                return response()->json(['validator' => true]);
            }
            else
            {
                return response()->json(['validator' => false]);
            }
        }
    }
}
