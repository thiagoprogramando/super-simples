<?php

namespace App\Http\Controllers;

use App\Models\teg;
use Illuminate\Http\Request;

class ApiTegController extends Controller
{
    public function addTag(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'user_id' => 'required|integer',
          
        ]);
    
        // Cria um novo registro na tabela "contas"
        $novatag = teg::create([
            'nome' => $validatedData['nome'],
            'user_id' => $validatedData['user_id'],
           
        ]);
    
        // Retorna a nova conta criada como resposta
        return response()->json(['tag' => $novatag], 201);

    }
    public function DelTag($id)
    {
        // Verifica se a conta existe
        $teg = teg::find($id);
        if (!$teg) {
            return response()->json(['message' => 'Conta não encontrada.'], 404);
        }

        // Deleta a conta e armazena o resultado em uma variável
        $deleted = $teg->delete();

        // Retorna uma resposta indicando se a conta foi deletada com sucesso ou não
        if ($deleted) {
            return response()->json(['deleted' => true], 200);
        } else {
            return response()->json(['deleted' => false], 500);
        }
    }
}
