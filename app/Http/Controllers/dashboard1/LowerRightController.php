<?php

namespace App\Http\Controllers\dashboard1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\model\LowerRightMenu1;

class LowerRightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = LowerRightMenu1::where('status', '!=', 2);
            
            return DataTables::of($data)
            ->addColumn('action', function($data)
            {
                $edit = '<button class="btn btn-info btn-xs edit" id="'.$data->id.'" title="Edit">
                <i class="fa fa-edit"></i></button>';

                $delete = '&nbsp;&nbsp;<button class="btn btn-danger btn-xs delete" id="'.$data->id.'" title="Delete">
                <i class="fa fa-trash"></i></button>';

                return $edit.''.$delete;
            })
            ->rawColumns(['action'])
            ->make('true');
        }

        return view('dashboard1.lower_right.index');
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
        $product_name = $request->product;

        $product = LowerRightMenu1::where('product_name', $product_name)->first();

        if($product)
        {
          return response()->json(['exist' => true]);
        }
        else
        {
          $image_addon = $request->file('image_addon');

          if($image_addon != null)
          {
            $new_image_addon = rand().'.'.$image_addon->getClientOriginalExtension();
            $image_addon->move(public_path('assets/images'), $new_image_addon);
          }

          $store = new LowerRightMenu1();
          $store->product_name = ucwords($request->product);
          $store->classification = ucwords($request->classification);
          $store->image_addon = $new_image_addon;

          if($store->save())
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
          $data = LowerRightMenu1::find($id);

          return response()->json(['productData' => $data]);
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
          $new_image_addon = $request->hidden_image_addon;

          $edit_image_addon = $request->file('edit_image_addon');

          if($edit_image_addon != null)
          {
            $new_image_addon = rand().'.'.$edit_image_addon->getClientOriginalExtension();
            $edit_image_addon->move(public_path('assets/images'), $new_image_addon);
          }

          $store = LowerRightMenu1::find($id);
          $store->product_name = ucwords($request->edit_product);
          $store->classification = ucwords($request->edit_classification);
          $store->image_addon = $new_image_addon;
          $store->status = $request->edit_status;

          if($store->save())
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
        $destroy = LowerRightMenu1::destroy($id);

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
