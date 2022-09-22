<?php

namespace App\Http\Controllers;

use App\Models\archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
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
        //
        if($request->hasFile(key:'archivo'))
        {
           $file = $request->archivo->store('public/archivos'); //guardamos el archivo en el storage
           $datosArchivo =request()->except('archivo'); //recuperamos todo excepto el archivo
           $nombreArchivo = $datosArchivo['nombreArchivo'];
           $descripcion = $datosArchivo['descripcion'];
           $status = $datosArchivo['status'];
           $autor = $datosArchivo['autor'];
           $tipo_archivo = $datosArchivo['tipo_archivo'];
        
           DB::insert('insert into archivos 
           (nombreArchivo, descripcion, status, archivo, autor, tipo_archivo_id) 
           values (?, ?, ?, ?, ?, ?)',
           [$nombreArchivo, $descripcion, $status, $file, $autor, $tipo_archivo]);

           return  redirect()->back();
        }

    }

    public function downloadFile($x)
    {
       $pathFile = public_path().'/storage/archivos/'.$x;
       return response()->download($pathFile);
    }

    public function obtenerArchivos($id)
    {
        $object = DB::table(DB::raw('archivos'))
        ->select(DB::raw(
            '*'
        ))
        ->where('tipo_archivo_id','=', $id)
        ->get();
        return $object;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(archivo $archivo)
    {
        //
    }
}
