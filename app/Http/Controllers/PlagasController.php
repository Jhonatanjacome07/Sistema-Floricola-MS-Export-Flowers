<?php

namespace App\Http\Controllers;


use App\Models\Plagas;
use Illuminate\Http\Request;

class PlagasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plagas = Plagas::all();
        return view('plagas.index', compact('plagas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plagas.create');
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

        ]);
        $plagas = new Plagas();
        $plagas->name = $request->input('name');

        $plagas->save();

        return redirect()->route('plagas.index');
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
        $plagas = Plagas::find($id);
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
        $plagas = Plagas::find($id);
        $plagas->name = $request->input('name');
        $plagas->save();
        return response()->json(['message' => 'Los datos han sido actualizados correctamente']);
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

    public function toggle(Plagas $plaga)
    {
        $plaga->status = !$plaga->status;
        $plaga->save();
        return response()->json(['message' => 'El estado ha sido actualizado correctamente']);
    }
}
