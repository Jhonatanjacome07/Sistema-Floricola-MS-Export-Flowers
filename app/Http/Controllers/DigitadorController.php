<?php

namespace App\Http\Controllers;

use App\Models\Bonches;
use App\Models\Flowers;
use App\Models\Recepcion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DigitadorController extends Controller
{
   
    public function index()
    {
        $Bonche = Bonches::all();
        return view('digitador.index', compact('Bonche')) ;
    }

    public function create()
    {
        $flowers = Flowers::all();
        return view('digitador.create',compact('flowers')) ;
    }

  
  
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'name' => 'required|string|max:75',
            'nbloque' => 'required|max:75',
            'cantidadtallos' => 'required|numeric|max:755',
            'medida' => 'required|numeric|max:755',
            'fecha' => 'required|date_format:Y-m-d', // Cambiado al formato de MySQL
        ]);
    
        $Bonche = new Bonches();
        $Bonche->name = $request->input('name');
        $Bonche->nbloque = $request->input('nbloque');
        $Bonche->cantidadtallos = $request->input('cantidadtallos');
        $Bonche->codigobarras = $request->input('codigobarras');
        $Bonche->medida = $request->input('medida');
        $Bonche->fecha = $request->input('fecha');
        $Bonche->save();
    
        // Mostrar SweetAlert para indicar que se ha creado correctamente
        return back()->with('status', 'user-registered');
    }
    
 
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
         
         $Bonche = Bonches::find($id);
         return view('digitador.edit', compact('Bonche'));
    }

    
    public function update(Request $request, $id)
    {
        $Bonche = Bonches::find($id);
        $Bonche->name = $request->input('name');
        $Bonche->nbloque = $request->input('nbloque');
        $Bonche->cantidadtallos = $request->input('cantidadtallos');
        $Bonche->codigobarras = $request->input('codigobarras');
        $Bonche->medida = $request->input('medida');
        $Bonche->fecha = $request->input('fecha');
        $Bonche->save();

        $Bonche->save();
        return response()->json(['message' => 'Los datos han sido actualizados correctamente']);
    }

  
    public function destroy(string $id)
    {
        $Boncheo  = Bonches::find($id);
        $Boncheo->delete();

        return back();
    }


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
    
    // Obtener los datos de boncheo
    $boncheo = Bonches::whereBetween('fecha', [$start_date, $end_date])->get();

    // Obtener los datos de recepción
    $recepciones = Recepcion::whereBetween('fecha', [$start_date, $end_date])->get();

    // Obtener las etiquetas y datos para el gráfico
    $labels = $boncheo->pluck('name')->unique()->values();
    $dataBoncheo = $boncheo->groupBy('name')->map(function ($group) {
        return $group->sum('cantidadtallos');
    })->values();
    $dataRecepcion = $recepciones->groupBy('name')->map(function ($group) {
        return $group->sum('cantidadtallos');
    })->values();

    // Combinar los datos para el gráfico
    $combinedData = $labels->map(function ($label, $index) use ($dataBoncheo, $dataRecepcion) {
        return [
            'label' => $label,
            'dataBoncheo' => $dataBoncheo[$index],
            'dataRecepcion' => isset($dataRecepcion[$index]) ? $dataRecepcion[$index] : 0,
        ];
    });

    // Obtener los datos para la tabla
    $tableData = $boncheo->map(function ($item) use ($recepciones) {
        $recepcion = $recepciones->where('name', $item->name)->first();
        $cantidadBonches = ceil($item->cantidadtallos / 25); // Calcular la cantidad de bonches (cada 25 tallos es 1 bonche)
        return [
            'name' => $item->name,
            'nbloque' => $item->nbloque,
            'created_at'=>$item->fecha,
            'cantidadTallosBoncheo' => $item->cantidadtallos,
            'medida' => $item->medida,
            'cantidadBonches' => $cantidadBonches,
            'cantidadtallosRecepcion' => $recepcion ? $recepcion->cantidadtallos : 0,
            'porcentajeBoncheo' => $recepcion ? ($item->cantidadtallos / $recepcion->cantidadtallos) * 100 : 0,
        ];
    });

    return view('digitador.reporte', compact('combinedData', 'tableData', 'start_date', 'end_date'));
}

    

}
