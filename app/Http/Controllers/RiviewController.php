<?php

namespace App\Http\Controllers;

use App\Models\Riview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class RiviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }

    public function list()
    {
        return view('riview.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riviews = Riview::all();
        
        return response()->json([
            'success' => true,
            'data' => $riviews
        ]);
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
            'id_member' => 'required',
            'id_produk' => 'required',
            'riview' => 'required',
            'rating' => 'required',
        ]);


        if($validator->fails()){
            return response()->json(
                $validator->errors(), 422
            );
        }

        $input = $request->all();
        
       $Riview = Riview::create($input);

       return response()->json([
        'success' => true,
           'data'=> $Riview
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Riview  $Riview
     * @return \Illuminate\Http\Response
     */
    public function show(Riview $Riview)
    {
        return response()->json([
            'success' => true,
            'data' => $Riview
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Riview  $Riview
     * @return \Illuminate\Http\Response
     */
    public function edit(Riview $Riview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Riview  $Riview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Riview $Riview)
    {

        $validator = Validator::make($request->all(),[
            'id_member' => 'required',
            'id_produk' => 'required',
            'riview' => 'required',
            'rating' => 'required',
        ]);


        if($validator->fails()){
            return response()->json(
                $validator->errors(), 422
            );
        }

        $input = $request->all();

        
        $Riview->update($input);
        
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $Riview
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Riview  $Riview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riview $Riview)
    {
         $Riview->delete();

        return response()->json([
            'success' => true,
            'message' => 'success'
        ]);
    }
}
