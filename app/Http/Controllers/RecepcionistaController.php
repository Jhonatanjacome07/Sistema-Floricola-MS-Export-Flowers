<?php

namespace App\Http\Controllers;

use App\Models\Flowers;
use App\Models\Recepcion;
use Barryvdh\DomPDF\Facade\Pdf;
use ConsoleTVs\Charts\Facades\Charts;

use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class RecepcionistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recepcion = Recepcion::all();
        return view('recepcion.index', compact('recepcion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flowers = Flowers::all();
        return view('recepcion.create', compact('flowers'));
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
            'name' => 'required|string|max:75',
            'nbloque' => 'required|max:75',
            'cantidadtallos' => 'required|numeric|max:755',
            'fecha' => 'required|date_format:Y-m-d', // Cambiado al formato de MySQL
        ]);

        $recepcion = new Recepcion();
        $recepcion->name = $request->input('name');
        $recepcion->nbloque = $request->input('nbloque');
        $recepcion->cantidadtallos = $request->input('cantidadtallos');
        $recepcion->fecha = Carbon::createFromFormat('Y-m-d', $request->input('fecha'))->format('Y-m-d');

        $recepcion->save();

        return back()->with('status', 'user-registered');
    }


    public function obtenerBloques(Request $request)
    {
        $nombreRosa = $request->input('name');
        $bloques = Flowers::where('name', $nombreRosa)->pluck('nbloque');

        return response()->json($bloques);
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
        //
        $recepcion = Recepcion::find($id);
        return view('recepcion.edit', compact('recepcion'));
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
        //
        $recepcion = Recepcion::find($id);
        $recepcion->name = $request->input('name');
        $recepcion->nbloque = $request->input('nbloque');
        $recepcion->cantidadtallos = $request->input('cantidadtallos');
        $recepcion->fecha = $request->input('fecha');

        $recepcion->save();
        return response()->json(['message' => 'Los datos han sido actualizados correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $recepcion = Recepcion::find($id);
        $recepcion->delete();
        return back();
    }



    /*
    public function reporte(Request $request)
    {
        // Lógica para obtener los datos
        $start_date = $request->input('start_date', Carbon::now()->startOfWeek());
        $end_date = $request->input('end_date', Carbon::now()->endOfWeek());
        $recepciones = Recepcion::whereBetween('created_at', [$start_date, $end_date])->get();
        // Datos para la gráfica de Google Charts
        $dataForChart = [['Nombre', 'Cantidad de Tallos']];
        foreach ($recepciones as $recepcion) {
            $dataForChart[] = [$recepcion->name, $recepcion->cantidadtallos];
        }
        return view('recepcion.reporte', compact('recepciones', 'dataForChart','start_date', 'end_date'));
    }
*/






    public function reporte(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if (!$start_date || !$end_date) {
            $start_date = Carbon::now()->startOfWeek();
            $end_date = Carbon::now()->endOfWeek();
        } else {
            $start_date = Carbon::parse($start_date)->startOfDay();
            $end_date = Carbon::parse($end_date)->endOfDay(); // Ajustar a final del día
        }

        $recepciones = Recepcion::whereBetween('fecha', [$start_date, $end_date])->get();

        $labels = $recepciones->pluck('name')->unique()->values();
        $data = $recepciones->groupBy('name')->map(function ($group) {
            return $group->sum('cantidadtallos');
        })->values();

        return view('recepcion.reporte', compact('labels', 'data', 'recepciones', 'start_date', 'end_date'));
    }
}
