<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlowersRequest;
use App\Models\Flowers;
use Illuminate\Http\Request;

class FlowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flowers = Flowers::all();
        return view('flowers.index', compact('flowers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flowers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'name' => 'Required|string|max:75',
            'nbloque' => 'Required|max:75',

        ]);
        $flowers  = new Flowers();
        $flowers->name = $request->input('name');
        $flowers->nbloque = $request->input('nbloque');

        $flowers->save();

        return redirect()->route('flowers.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flowers = Flowers::find($id);
        return back();
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
        $flowers = Flowers::find($id);
        $flowers->name = $request->input('name');
        $flowers->nbloque = $request->input('nbloque');
        $flowers->save();
        return response()->json(['message' => 'Los datos han sido actualizados correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flowers $flowers)
    {
        $flowers->delete();
        return redirect()->action([FlowersController::class, 'index'])
            ->with('success-delete', 'Variedad Eliminada con éxito');
    }
    public function toggle(Flowers $flower)
    {
        $flower->status = !$flower->status;
        $flower->save();

        return response()->json(['message' => 'El estado ha sido actualizado correctamente']);
    }
}
