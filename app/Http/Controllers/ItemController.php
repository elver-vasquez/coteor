<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Item;
use App\Models\Categoria;
use Carbon\Carbon;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias=Categoria::all();
        return view('items.index',["categorias"=>$categorias]);
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


       try {
           $i = new Item();
           $status = 200;
           $msg = "Registro exitoso.";
           $i->codigo = $request['codigo'];
           $i->tipo = $request['tipo'];
           $i->descripcion=strtoupper($request['descripcion']);
           $i->estado = '0';
           $i->fecha_alta = Carbon::now();
           $i->unidad = $request['unidad'];
           $i->categorias_id = $request['idcategorias'];
           $i->save();


       }
       catch (Exception $e){
           $status=500;
           $msg="Se produjo  un error al Registrar el item";
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

        $i=Item::with('categoria')->get()->find($id);
         return response()->json($i->toArray());
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
        return dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public  function listar(){
//        $i=Item::all();
        $i=Item::with('categoria')->get();

        return response()->json([
            "data"=>$i->toArray()
        ]);
    }
}
