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

    public function addContas(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'conta' => 'required|string',
            'pagar_ao_receber' => 'required|integer',
            'pagar_ao_receber_status' => 'required|integer',
            'tag' => 'nullable|string',
            'valor' => 'required|numeric',
            'data' => 'required|date',
            'status' => 'required|integer',
            'user_id' => 'required|integer',
        ]);
    
        // Cria um novo registro na tabela "contas"
        $novaConta = Contas::create([
            'conta' => $validatedData['conta'],
            'pagar_ao_receber' => $validatedData['pagar_ao_receber'],
            'pagar_ao_receber_status' => $validatedData['pagar_ao_receber_status'],
            'tag' => $validatedData['tag'] ?? null, // campo opcional
            'valor' => $validatedData['valor'],
            'data' => $validatedData['data'],
            'status' => $validatedData['status'],
            'user_id' => $validatedData['user_id'],
        ]);
    
        // Retorna a nova conta criada como resposta
        return response()->json(['conta' => $novaConta], 201);
    }

    

    public function update($id, Request $request)
    {

        $conta = Contas::find($id);
    
        // Verifica se a conta existe
        if (!$conta) {
            return response()->json(['message' => 'Conta não encontrada.'], 404);
        }
    
        $updated = $conta->update([
            'conta' => $request->input('conta'),
            'pagar_ao_receber' => $request->input('pagar_ao_receber'),
            'pagar_ao_receber_status' => $request->input('pagar_ao_receber_status'),
            'tag' => $request->input('tag'),
            'valor' => $request->input('valor'),
            'data' => $request->input('data'),
            'status' => $request->input('status')
        ]);
    
        // Retorna um valor booleano indicando se a conta foi atualizada com sucesso
        return response()->json(['updated' => $updated], 200);
    }

    public function delete($id)
    {
        // Verifica se a conta existe
        $conta = Contas::find($id);
        if (!$conta) {
            return response()->json(['message' => 'Conta não encontrada.'], 404);
        }

        // Deleta a conta e armazena o resultado em uma variável
        $deleted = $conta->delete();

        // Retorna uma resposta indicando se a conta foi deletada com sucesso ou não
        if ($deleted) {
            return response()->json(['deleted' => true], 200);
        } else {
            return response()->json(['deleted' => false], 500);
        }
    }

    
    
      
}
    

    
    
    
    
    
    

