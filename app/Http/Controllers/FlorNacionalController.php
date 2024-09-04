<?php

namespace App\Http\Controllers;

use App\Models\Flowers;
use App\Models\FlorNacional;
use App\Models\Plagas;
use App\Models\Recepcion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlorNacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flornacional = FlorNacional::all();
        return view('flornacional.index', compact('flornacional'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $flowers = Flowers::all();
        $plagas = Plagas::all();
        return view('flornacional.create', compact('flowers', 'plagas'));
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
            'cantidadtallos' => 'Required|numeric|max:75',
            'motivo' => 'Required|string|max:75',
        ]);

        $flornacional = new FlorNacional();
        $flornacional->name = $request->input('name');
        $flornacional->nbloque = $request->input('nbloque');
        $flornacional->cantidadtallos = $request->input('cantidadtallos');
        $flornacional->plaga = $request->input('motivo');
        $flornacional->fecha = $request->input('fecha');
        $flornacional->save();
        return back()->with('status', 'user-registered');
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
        //
        $flornacional = FlorNacional::find($id);
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
        $flornacional = FlorNacional::find($id);
        $flornacional->name = $request->input('name');
        $flornacional->nbloque = $request->input('nbloque');
        $flornacional->cantidadtallos = $request->input('cantidadtallos');
        $flornacional->plaga = $request->input('plaga');
        $flornacional->fecha = $request->input('fecha');
        $flornacional->save();
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
        $flornacional = FlorNacional::find($id);
        $flornacional->delete();
        return back();
    }

    public function reporteFlorNacional(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if (!$start_date || !$end_date) {
            $start_date = Carbon::now()->startOfWeek();
            $end_date = Carbon::now()->endOfWeek();
        } else {
            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date)->addDay(); // Agregar un día para incluir el último día
        }

        // Obtener los datos de flor nacional
        $florNacional = FlorNacional::whereBetween('fecha', [$start_date, $end_date])->get();

        // Obtener los datos de recepción
        $recepciones = Recepcion::whereBetween('fecha', [$start_date, $end_date])->get();

        // Obtener las etiquetas y datos para el gráfico
        $labels = $florNacional->pluck('name')->unique()->values();
        $dataFlorNacional = $florNacional->groupBy('name')->map(function ($group) {
            return $group->sum('cantidadtallos');
        })->values();
        $dataRecepcion = $recepciones->groupBy('name')->map(function ($group) {
            return $group->sum('cantidadtallos');
        })->values();

        // Combinar los datos para el gráfico
        $combinedData = $labels->map(function ($label, $index) use ($dataFlorNacional, $dataRecepcion) {
            return [
                'label' => $label,
                'dataFlorNacional' => $dataFlorNacional[$index],
                'dataRecepcion' => isset($dataRecepcion[$index]) ? $dataRecepcion[$index] : 0,
            ];
        });

        // Obtener los datos para la tabla
        $tableData = $florNacional->map(function ($item) use ($recepciones) {
            $recepcion = $recepciones->where('name', $item->name)->first();
            return [
                'name' => $item->name,
                'nbloque' => $item->nbloque,
                'plaga' => $item->plaga,
                'cantidadtallosFlorNacional' => $item->cantidadtallos,
                'cantidadtallosRecepcion' => $recepcion ? $recepcion->cantidadtallos : 0,
                'porcentajeFlorNacional' => $recepcion ? ($item->cantidadtallos / $recepcion->cantidadtallos) * 100 : 0,
            ];
        });

        return view('flornacional.reporte', compact('combinedData', 'tableData', 'start_date', 'end_date'));
    }


    public function reporteFlorNacionalParametros(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $plaga = $request->input('plaga');
    
        // Formatear las fechas en el formato adecuado ('Y-m-d')
        $start_date = Carbon::parse($start_date)->startOfDay()->toDateString();
        $end_date = Carbon::parse($end_date)->endOfDay()->toDateString();
    
        if (!$start_date || !$end_date) {
            $start_date = Carbon::now()->startOfWeek()->toDateString();
            $end_date = Carbon::now()->endOfWeek()->toDateString();
        }
    
        // Obtener los datos de flor nacional con filtro por fecha y plaga
        $florNacionalQuery = FlorNacional::whereBetween('fecha', [$start_date, $end_date]);
        if ($plaga) {
            $florNacionalQuery->where('plaga', $plaga);
        }
        $florNacional = $florNacionalQuery->get();
    
        // Obtener los datos de recepción con filtro por fecha
        $recepciones = Recepcion::whereBetween('fecha', [$start_date, $end_date])->get();
    

        // Obtener las etiquetas y datos para el gráfico
        $labels = $florNacional->pluck('name')->unique()->values();
        $dataFlorNacional = $florNacional->groupBy('name')->map(function ($group) {
            return $group->sum('cantidadtallos');
        })->values();
        $dataRecepcion = $recepciones->groupBy('name')->map(function ($group) use ($start_date, $end_date) {
            return $group->whereBetween('fecha', [$start_date, $end_date])->sum('cantidadtallos');
        })->values();

        // Combinar los datos para el gráfico
        $combinedData = $labels->map(function ($label, $index) use ($dataFlorNacional, $dataRecepcion) {
            return [
                'label' => $label,
                'dataFlorNacional' => $dataFlorNacional[$index],
                'dataRecepcion' => isset($dataRecepcion[$index]) ? $dataRecepcion[$index] : 0,
            ];
        });

        // Obtener los datos para la tabla

        $tableData = $florNacional->map(function ($item) use ($recepciones, $start_date, $end_date) {
            $recepcion = $recepciones->where('name', $item->name)
                ->whereBetween('fecha', [$start_date, $end_date])
                ->first();
            $receptionCount = $recepcion ? $recepciones->where('name', $item->name)
                ->whereBetween('fecha', [$start_date, $end_date])
                ->sum('cantidadtallos') : 0;

            // Convertir la fecha a un objeto Carbon
            $fecha = Carbon::parse($item->fecha);

            return [
                'fecha' => $fecha->format('d-m-Y'), // Formato DD-MM-YYYY
                'name' => $item->name,
                'nbloque' => $item->nbloque,
                'plaga' => $item->plaga,
                'cantidadtallosFlorNacional' => $item->cantidadtallos,
                'cantidadtallosRecepcion' => $receptionCount,
                'porcentajeFlorNacional' => $recepcion ? ($item->cantidadtallos / $recepcion->cantidadtallos) * 100 : 0,
            ];
        })->filter(function ($item) {
            return $item['cantidadtallosRecepcion'] > 0; // Filtrar solo los registros con cantidad de tallos de recepción mayor a 0
        });

        // Obtener las plagas disponibles
        $plagas = FlorNacional::pluck('plaga')->unique()->values();

        return view('flornacional.reporteparametros', compact('combinedData', 'tableData', 'start_date', 'end_date', 'plagas'));
    }
}
