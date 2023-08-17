<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function store(Request $request)
    {
        // Valide os dados do formulário antes de criar o cliente
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'contato' => 'required|max:255',
            'vencimento' => 'required|date',
        ]);

        // Crie um novo cliente no banco de dados usando o modelo Cliente
        try {
            Cliente::create($request->all());
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        // Redirecione para a página adequada após a criação do cliente
        // return redirect('/clientes')->with('success', 'Cliente criado com sucesso!');
    }

    public function index()
    {
        $clientes = Cliente::all();


        return response()->json($clientes);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        // Valide os dados do formulário antes de atualizar o cliente
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'contato' => 'required|max:255',
            'vencimento' => 'required|date',
            'status' => 'required',
        ]);

        // Atualize os campos do cliente com os dados validados
        $cliente->update($request->all());

        return response()->json([
            'message' => 'Cliente atualizado com sucesso!'
        ]);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return response()->json($cliente);
    }
}
