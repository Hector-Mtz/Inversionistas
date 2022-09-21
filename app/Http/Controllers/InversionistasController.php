<?php

namespace App\Http\Controllers;

use App\Models\inversionistas;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InversionistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Inversionistas/main');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inversionistas  $inversionistas
     * @return \Illuminate\Http\Response
     */
    public function show(inversionistas $inversionistas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inversionistas  $inversionistas
     * @return \Illuminate\Http\Response
     */
    public function edit(inversionistas $inversionistas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inversionistas  $inversionistas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inversionistas $inversionistas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inversionistas  $inversionistas
     * @return \Illuminate\Http\Response
     */
    public function destroy(inversionistas $inversionistas)
    {
        //
    }
}
