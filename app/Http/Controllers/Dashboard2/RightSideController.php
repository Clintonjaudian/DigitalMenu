<?php

namespace App\Http\Controllers\Dashboard2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\RightSide;
use App\model\RightSideAddon;
use Yajra\DataTables\Facades\DataTables;

class RightSideController extends Controller
{
    public function add_on(Request $request)
    {
      if($request->ajax())
      {
        $id = $request->id;

        $data = RightSideAddon::select('id', 'add_on', 'pcs', 'status')
        ->where([
          ['right_side_id', $id],
          ['status', '<>', 2] 
        ])->get();

        return response()->json(['add_on_data' => $data]);
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = RightSide::where('status', '!=', 2);
            
            return DataTables::of($data)
            ->addColumn('action', function($data)
            {
                $edit = '<button class="btn btn-info btn-xs edit" id="'.$data->id.'" title="Edit">
                <i class="fa fa-edit"></i></button>';

                $delete = '&nbsp;&nbsp;<button class="btn btn-danger btn-xs delete" id="'.$data->id.'" title="Delete">
                <i class="fa fa-trash"></i></button>';

                return $edit.''.$delete;
            })
            ->addColumn('add_on', function($data)
            {
              $add_on = '<button class="btn btn-success btn-sm add_on" id="'.$data->id.'" title="View Add-on">
              Add-on</button>';

              return $add_on;
            })
            ->rawColumns(['action', 'add_on'])
            ->make('true');
        }

        return view('dashboard2.right_side.index');
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
        $classification = $request->classification;

        $exist = RightSide::where('classification', $classification)->first();

        if($exist)
        {
          return response()->json(['exist' => true]);
        }
        else
        {
          $product_image = $request->file('product_image');
          $price_tag = $request->file('price_tag');

          if($product_image != null)
          {
            $new_product_image = rand().'.'.$product_image->getClientOriginalExtension();
            $product_image->move(public_path('assets/images'), $new_product_image);
          }

          if($price_tag != null)
          {
            $new_price_tag = rand().'.'.$price_tag->getClientOriginalExtension();
            $price_tag->move(public_path('assets/images'), $new_price_tag);
          }

          $store = new RightSide();
          $store->classification = ucwords($request->classification);
          $store->product_image = $new_product_image;
          $store->price_tag = $new_price_tag;

          if($store->save())
          {
            // Add-on
            $right_side_id = $store->id;
            $add_on = $request->add_on;
            $pcs = $request->pcs;

            for($count = 0; $count < count($add_on); $count++) 
            { 
              $data = array(
                'right_side_id' => $right_side_id,
                'add_on' => ucwords($add_on[$count]),
                'pcs' => $pcs[$count],
              );

              $insert_data[] = $data;
            }

            $store_add_on = RightSideAddon::insert($insert_data);

            if($store_add_on)
            {
              return response()->json(['validator' => true]);
            }
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
            $data = RightSide::find($id);

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
          $new_product_image = $request->hidden_product_image;
          $new_price_tag = $request->hidden_price_tag;

          $edit_product_image = $request->file('edit_product_image');
          $edit_price_tag = $request->file('edit_price_tag');

          if($edit_product_image != null)
          {
            $new_product_image = rand().'.'.$edit_product_image->getClientOriginalExtension();
            $edit_product_image->move(public_path('assets/images'), $new_product_image);
          }

          if($edit_price_tag != null)
          {
            $new_price_tag = rand().'.'.$edit_price_tag->getClientOriginalExtension();
            $edit_price_tag->move(public_path('assets/images'), $new_price_tag);
          }

          $update = RightSide::find($id);

          $update->classification = ucwords($request->edit_classification);
          $update->status = $request->edit_status;
          $update->product_image = $new_product_image;
          $update->price_tag = $new_price_tag;

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
        $destroy = RightSide::destroy($id);
  
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
