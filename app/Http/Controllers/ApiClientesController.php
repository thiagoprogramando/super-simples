<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\teg;
use Illuminate\Http\Request;

class ApiClientesController extends Controller
{

    public function addCliente(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'cpfcnpj' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        $cliente = new Clientes();
        $cliente->nome = $validatedData['nome'];
        $cliente->cpfcnpj = $validatedData['cpfcnpj'];
        $cliente->user_id = $validatedData['user_id'];

        // Verifica se os campos opcionais foram fornecidos e, em caso afirmativo, os atribui ao modelo
        if ($request->has('whatsapp')) {
            $cliente->whatsapp = $request->whatsapp;
        }

        if ($request->has('endereco')) {
            $cliente->endereco = $request->endereco;
        }

        if ($request->has('site')) {
            $cliente->site = $request->site;
        }

        if ($request->has('tag')) {
            $cliente->tag = $request->tag;
        }

        $cliente->save();

        return response()->json(['success' => true, 'message' => 'Cliente adicionado com sucesso.']);
    }

    public function upCliente(Request $request, $id)
    {
    

        $cliente = Clientes::find($id);
    
        // Verifica se os campos opcionais foram fornecidos e, em caso afirmativo, os atribui ao modelo
        if ($request->has('nome')) {
            $cliente->whatsapp = $request->whatsapp;
        }
        if ($request->has('cpfcnpj')) {
            $cliente->whatsapp = $request->whatsapp;
        }
        if ($request->has('user_id')) {
            $cliente->whatsapp = $request->whatsapp;
        }
        if ($request->has('whatsapp')) {
            $cliente->whatsapp = $request->whatsapp;
        }

        if ($request->has('endereco')) {
            $cliente->endereco = $request->endereco;
        }

        if ($request->has('site')) {
            $cliente->site = $request->site;
        }

        if ($request->has('tag')) {
            $cliente->tag = $request->tag;
        }

        $cliente->save();

        return response()->json(['success' => true, 'message' => 'Cliente atualizado com sucesso.']);
    }

    public function deleteCliente($id)
    {
        // Verifica se a conta existe
        $cliente = Clientes::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Conta não encontrada.'], 404);
        }

        // Deleta a conta e armazena o resultado em uma variável
        $deleted = $cliente->delete();

        // Retorna uma resposta indicando se a conta foi deletada com sucesso ou não
        if ($deleted) {
            return response()->json(['deleted' => true], 200);
        } else {
            return response()->json(['deleted' => false], 500);
        }
    }
  
}
