<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function store(Request $request)
    {

        // Valide os dados do formulário antes de criar o cliente
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'cpf' => 'required|max:255',
            'contato' => 'required|max:255',
            'endereco' => 'required|max:255',
            'numeropessoas' => 'required|max:255',
            'observacao' => 'max:255',
            'servico' => 'required|max:255',
            'valor' => 'required|max:255',
            'vencimento' => 'required|date',
        ]);

        // Crie um novo cliente no banco de dados usando o modelo Cliente
        $cliente = Cliente::create($request->all());

        // Retorne o ID do cliente na resposta
        return response()->json([
            'status' => $cliente->status,
            'id' => $cliente->id
        ]);
    }

    public function index(Request $request)
    {
        $clientes = Cliente::orderBy('created_at', 'desc')
        ->when($request->has('search'), function ($query) use ($request) {
            return $query->where(function ($subquery) use ($request) {
                $searchType = $request->get('status');

                if ($searchType === 'pago') {
                    $subquery->where('status', 'pago');
                } elseif ($searchType === 'vencido') {
                    $subquery->where('status', 'vencido');
                } elseif ($searchType === 'pendente') {
                    $subquery->where('status', 'pendente');
                } elseif ($searchType === 'cancelado') {
                    $subquery->where('status', 'cancelado');
                }
            });
        })
        ->when($request->has('search'), function ($query) use ($request) {
            return $query->where(function ($subquery) use ($request) {
                $searchType = $request->get('searchType');
                $searchValue = $request->has('search') && $request->filled('search') ? mb_strtolower($request->get('search')) : '';

                if ($searchType === 'autor') {
                    $subquery->where('name', 'like', '%' . $searchValue . '%');
                } elseif ($searchType === 'idUser') {
                    $subquery->where('id', 'like', '%' . trim($searchValue) . '%');
                } elseif ($searchType === 'cpfUser') {
                    $subquery->where('cpf', 'like', '%' . trim($searchValue) . '%');
                }
            });
        })
        ->paginate(8);

        return response()->json($clientes);

    }


    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        // Valide os dados do formulário antes de atualizar o cliente
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'cpf' => 'required|max:255',
            'contato' => 'required|max:255',
            'endereco' => 'required|max:255',
            'numeropessoas' => 'required|max:255',
            'observacao' => 'max:255',
            'servico' => 'required|max:255',
            'valor' => 'required|max:255',
            'vencimento' => 'required|date',
            'status' => 'required',
        ]);

        // Atualize os campos do cliente com os dados validados
        $cliente->update($request->all());

        return response()->json([
            'status' => $cliente->status,
            'message' => 'Cliente atualizado com sucesso!'
        ]);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return response()->json($cliente);
    }


    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
    }

    public function downloadUserData($id)
    {
        $cliente = Cliente::findOrFail($id);

        // Crie um array com os dados que você deseja incluir no arquivo
        $data = [
            'Nome: ' => $cliente->name,
            'CPF: ' => $cliente->cpf,
            'Contato: ' => $cliente->contato,
            'Numero de Pessoas na casa: ' => $cliente->numeropessoas,
            'Endereço: ' => $cliente->endereco,
            'Serviço: ' => $cliente->servico,
            'Valor: ' => $cliente->valor,
            'Cliente criado: ' => $cliente->created_at,
        ];

        // Se a opção de pagamento estiver selecionada, adicione a data do pagamento aos dados
        if ($cliente->status == 'pago') {
            $data['Data do Pagamento: '] = $cliente->created_at;
        }

        $data['Data de Vencimento: '] = $cliente->vencimento;

        // Crie uma view com os dados
        $pdf = PDF::loadView('user_data', ['data' => $data]);

        // Defina o nome do arquivo PDF
        $filename = 'recibo_' . $cliente->name . '.pdf';

        // Faça o download do PDF
        return $pdf->download($filename);
    }

    public function graphs()
    {
        try {
            // Total de usuários agrupados por endereço
            $clientesPorEndereco = Cliente::select('endereco', DB::raw('count(*) as total'))
                ->groupBy('endereco')
                ->pluck('total', 'endereco');

            // Total de usuários agrupados por status
            $clientesPorStatus = Cliente::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');

            // Total de pessoas por cliente

            $clientesNumerosPessoas = Cliente::select('numeropessoas', DB::raw('count(*) as total'))
            ->groupBy('numeropessoas')
            ->pluck('total', 'numeropessoas');


            return response()->json([
                'clientesPorEndereco' => $clientesPorEndereco,
                'clientesPorStatus' => $clientesPorStatus,
                'clientesNumerosPessoas' => $clientesNumerosPessoas
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar dados dos gráficos: ' . $e->getMessage()], 500);
        }
    }


}
