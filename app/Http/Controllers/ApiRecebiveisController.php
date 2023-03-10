<?php

namespace App\Http\Controllers;

use App\Models\Recebiveis;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ApiRecebiveisController extends Controller
{
   

    public function listRecebiveis(Request $request, $id)
    {
        $query = Recebiveis::where('user_id', $id);
    
        // Tratamento de datas
        try {
            if ($request->has('dtInicial')) {
                $dtInicial = Carbon::createFromFormat('d/m/Y', $request->input('dtInicial'));
                $query->where('data', '>=', $dtInicial->format('Y-m-d'));
            }
    
            if ($request->has('dtFinal')) {
                $dtFinal = Carbon::createFromFormat('d/m/Y', $request->input('dtFinal'));
                $query->where('data', '<=', $dtFinal->format('Y-m-d'));
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Data inválida'], 400);
        }
    
        // Filtro por status
        $status = $request->input('status');
        if ($status !== null) {
            $query->where('status', '=', $status);
        }
    
        // Retorno dos resultados em formato JSON
        return $query->get()->toJson();
    }
    

    public function addRecebiveis(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'cliente' => 'required|string',
            'cliente_id' => 'required|integer',
            'tag' => 'required|integer',
            'valor' => 'required|numeric',
            'data' => 'required|date',
            'status' => 'required|integer',
            'parcela' => 'required|integer',
            'valor_parcela' => 'required|numeric',
            'user_id' => 'required|integer',
        ]);
    
        // Cria um novo registro na tabela 
        $novaRecebivel = Recebiveis::create([
            'cliente' => $validatedData['cliente'],
            'cliente_id' => $validatedData['cliente_id'],
            'tag' => $validatedData['tag'] ?? null, // campo opcional
            'valor' => $validatedData['valor'],
            'data' => $validatedData['data'],
            'status' => $validatedData['status'],
            'parcela' => $validatedData['parcela'],
            'valor_parcela' => $validatedData['valor_parcela'],
            'user_id' => $validatedData['user_id'],
        ]);
    
        // Retorna a nova conta criada como resposta
        return response()->json(['Recebiveis' => $novaRecebivel], 201);
    }

    

    public function upRecebiveis($id, Request $request)
    {

        $conta = Recebiveis::find($id);
    
        // Verifica se a conta existe
        if (!$conta) {
            return response()->json(['message' => 'Conta não encontrada.'], 404);
        }
    
        $updated = $conta->update([
            'cliente' => $request->input('cliente'),
            'cliente_id' => $request->input('cliente_id'),
            'tag' => $request->input('tag'),
            'valor' => $request->input('valor'),
            'data' => $request->input('data'),
            'status' => $request->input('status'),
            'parcela' => $request->input('parcela'),
            'valor_parcela' => $request->input('valor_parcela'),
            'user_id' => $request->input('user_id')
        ]);
    
        // Retorna um valor booleano indicando se a conta foi atualizada com sucesso
        return response()->json(['updated' => $updated], 200);
    }

    public function delete($id)
    {
        // Verifica se a conta existe
        $recebiveis = Recebiveis::find($id);
        if (!$recebiveis) {
            return response()->json(['message' => 'Conta não encontrada.'], 404);
        }

        // Deleta a conta e armazena o resultado em uma variável
        $deleted = $recebiveis->delete();

        // Retorna uma resposta indicando se a conta foi deletada com sucesso ou não
        if ($deleted) {
            return response()->json(['deleted' => true], 200);
        } else {
            return response()->json(['deleted' => false], 500);
        }
    }

    
    
      
}
    

    
    
    
    
    
    

