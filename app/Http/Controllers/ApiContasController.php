<?php

namespace App\Http\Controllers;

use App\Models\Contas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiContasController extends Controller
{
   

    public function listContas(Request $request, $id)
    {
        $query = Contas::where('user_id', $id);
    
        if ($request->has('dtInicial')) {
            $dtInicial = Carbon::createFromFormat('d/m/Y', $request->input('dtInicial'));
            $query->where('data', '>=', $dtInicial->format('Y-m-d'));
        }
    
        if ($request->has('dtFinal')) {
            $dtFinal = Carbon::createFromFormat('d/m/Y', $request->input('dtFinal'));
            $query->where('data', '<=', $dtFinal->format('Y-m-d'));
        }
    
        $status = $request->input('status');
        if ($status !== null) {
            $query->where('status', '=', $status);
        }
        $indicador = $request->input('indicador');
        if ($indicador == 1) {

            $query->where('pagar_ao_receber_status', '=', 1);
        }else{
            
        }
    
        $contas = $query->get();
    
      
        foreach ($contas as $conta) {
            $conta->indicador = $request->has('indicador') ? ($conta->pagar_ao_receber_status == 1 ? true : false) : null;
        }
    
        return response()->json($contas);
    }
    
    
    
    
    
    
    
    
}
