<?php

namespace App\Http\Controllers\Dashboard2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LowerRight;
use Yajra\DataTables\Facades\DataTables;

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
            $data = LowerRight::where('status', '!=', 2);
            
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

        return view('dashboard2.lower.right');
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

        $product = LowerRight::where('product_name', $product_name)->first();

        if($product)
        {
          return response()->json(['exist' => true]);
        }
        else
        {
          $image_addon1 = $request->file('image_addon1');
          $image_addon2 = $request->file('image_addon2');

          if($image_addon1 != null)
          {
            $new_image_addon1 = rand().'.'.$image_addon1->getClientOriginalExtension();
            $image_addon1->move(public_path('assets/images'), $new_image_addon1);
          }

          if($image_addon2 != null)
          {
            $new_image_addon2 = rand().'.'.$image_addon2->getClientOriginalExtension();
            $image_addon2->move(public_path('assets/images'), $new_image_addon2);
          }

          $store = new LowerRight();
          $store->product_name = ucwords($request->product);
          $store->classification = ucwords($request->classification);
          $store->image_addon1 = $new_image_addon1;
          $store->image_addon2 = $new_image_addon2;

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
          $data = LowerRight::find($id);

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
          $new_image_addon1 = $request->hidden_image_addon1;
          $new_image_addon2 = $request->hidden_image_addon2;

          $edit_image_addon1 = $request->file('edit_image_addon1');
          $edit_image_addon2 = $request->file('edit_image_addon2');

          if($edit_image_addon1 != null)
          {
            $new_image_addon1 = rand().'.'.$edit_image_addon1->getClientOriginalExtension();
            $edit_image_addon1->move(public_path('assets/images'), $new_image_addon1);
          }

          if ($edit_image_addon2 != null) 
          {
            $new_image_addon2 = rand().'.'.$edit_image_addon2->getClientOriginalExtension();
            $edit_image_addon2->move(public_path('assets/images'), $new_image_addon2);
          }

          $store = LowerRight::find($id);
          $store->product_name = ucwords($request->edit_product);
          $store->classification = ucwords($request->edit_classification);
          $store->image_addon1 = $new_image_addon1;
          $store->image_addon2 = $new_image_addon2;
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
      $destroy = LowerRight::destroy($id);

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
