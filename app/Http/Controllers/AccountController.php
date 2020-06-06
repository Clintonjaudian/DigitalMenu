<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class AccountController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = User::where('status', '!=', 2);

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

        return view('accounts.index');
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
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|unique:users',
            'name' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if($validator->fails())
        {
            return response()->json([
                'messages' => $validator->errors()
            ]);
        }

        $form_data = array(
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'remember_token' => Str::random(10),
        );

        User::create($form_data);
        return response()->json([
            'success' => true
        ]);
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
        if (request()->ajax()) 
        {
            $data = User::find($id);

            return response()->json(["user_data" => $data]);
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
            $rules = array(
                'edit_name' => 'required|string',
                'edit_email' => 'required|email',
                'edit_status' => 'required'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $data = User::find($id);

            $data->name = ucwords($request->edit_name);
            $data->email = $request->edit_email;
            $data->status = $request->edit_status;

            if($data->save())
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
        $destroy = User::find($id);
        $destroy->status = 2;

        if ($destroy->save()) 
        {
            return response()->json(['success' => true]);
        }
        else
        {
            return response()->json(['success' => false]);
        }
    }
}
