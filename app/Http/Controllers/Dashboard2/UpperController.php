<?php

namespace App\Http\Controllers\Dashboard2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Upper;
use Yajra\DataTables\Facades\DataTables;

class UpperController extends Controller
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
            $data = Upper::where('status', '!=', 2);
            
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

        return view('dashboard2.upper.index');
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

        $product = Upper::where('product', $product_name)->first();

        if($product)
        {
            return response()->json(['exist' => true]);
        }
        else
        {
            $food_image = $request->file('food_image');
            $original_price = $request->file('original_price');
            $dou_price = $request->file('dou_price');
            $trio_price = $request->file('trio_price');

            if($food_image != null)
            {
                $new_food_image = rand().'.'.$food_image->getClientOriginalExtension();
                $food_image->move(public_path('assets/images'), $new_food_image);
            }

            if($original_price != null)
            {
                $new_original_price = rand().'.'.$original_price->getClientOriginalExtension();
                $original_price->move(public_path('assets/images'), $new_original_price);
            }

            if($dou_price != null)
            {
                $new_dou_price = rand().'.'.$dou_price->getClientOriginalExtension();
                $dou_price->move(public_path('assets/images'), $new_dou_price);
            }

            if($trio_price != null)
            {
                $new_trio_price = rand().'.'.$trio_price->getClientOriginalExtension();
                $trio_price->move(public_path('assets/images'), $new_trio_price);
            }

            $store = new Upper();
            $store->product = ucwords($request->product);
            $store->food_image = $new_food_image;
            $store->original_price = $new_original_price;
            $store->dou_price = $new_dou_price;
            $store->trio_price = $new_trio_price;

            if ($store->save()) 
            {
                return response()->json(['success' => true]);
            }
            else
            {
                return response()->json(['success' => false]);
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
            $data = Upper::find($id);
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
            $new_food_image = $request->hidden_food_image;
            $edit_food_image = $request->file('edit_food_image');

            $new_original_price = $request->hidden_original_price;
            $edit_original_price = $request->file('edit_original_price');

            $new_dou_price = $request->hidden_dou_price;
            $edit_dou_price = $request->file('edit_dou_price');

            $new_trio_price = $request->hidden_trio_price;
            $edit_trio_price = $request->file('edit_trio_price');

            if($edit_food_image != '')
            {
                $new_food_image = rand().'.'.$edit_food_image->getClientOriginalExtension();
                $edit_food_image->move(public_path('assets/images'), $new_food_image);
            }

            if($edit_original_price != '')
            {
                $new_original_price = rand().'.'.$edit_original_price->getClientOriginalExtension();
                $edit_original_price->move(public_path('assets/images'), $new_original_price);
            }

            if($edit_dou_price != '')
            {
                $new_dou_price = rand().'.'.$edit_dou_price->getClientOriginalExtension();
                $edit_dou_price->move(public_path('assets/images'), $new_dou_price);
            }

            if($edit_trio_price != '')
            {
                $new_trio_price = rand().'.'.$edit_trio_price->getClientOriginalExtension();
                $edit_trio_price->move(public_path('assets/images'), $new_trio_price);
            }

            $update = Upper::find($id);

            $update->product = ucwords($request->edit_product);
            $update->status = $request->edit_status;
            $update->food_image = $new_food_image;
            $update->original_price = $new_original_price;
            $update->dou_price = $new_dou_price;
            $update->trio_price = $new_trio_price;

            if($update->save())
            {
                return response()->json(['success' => true]);
            }
            else
            {
                return response()->json(['success' => false]);
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
        $destroy = Upper::destroy($id);

        if($destroy)
        {
            return response()->json(['success' => true]);
        }
        else
        {
            return response()->json(['success' => false]);
        }
    }
}
