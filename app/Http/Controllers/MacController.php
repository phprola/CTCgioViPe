<?php

namespace App\Http\Controllers;

use App\Models\Mac;
use Illuminate\Http\Request;

class MacController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $macs = Mac::all();

        return view('macList')->with(['macs' => $macs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('macForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required | max: 35',
                'contador' => 'required',
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 35 caracteres',
                'contador.required' => 'O contador é obrigatório',
            ]
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'nome' => $request->nome,
            'contador' => $request->contador,
        ];

        //dd( $request->nome);
        //passa o vetor com os dados do formulário como parametro para ser salvo
        Mac::create($dados);

        return \redirect('mac')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mac = Mac::findOrFail($id);

        return view('macForm')->with([
            'mac' => $mac,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mac = Mac::findOrFail($id);

        return view('macForm')->with([
            'mac' => $mac,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nome' => 'required | max: 35',
                'contador' => 'required',
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 35 caracteres',
                'contador.required' => 'O contador é obrigatório',
            ]
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'nome' => $request->nome,
            'contador' => $request->contador,
        ];

        //dd( $request->nome);
        //passa o vetor com os dados do formulário como parametro para ser salvo
        Mac::upgradeOrCreate(
            ['id' => $request->id], $dados
        );

        return \redirect('mac')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mac = Mac::findOrFail($id);

        // verifica se existe o arquivo vinculado ao registro e depois remove
        $mac->delete();
        return \redirect('mac')->with('success', 'Removido com sucesso!');
    }

    function search(Request $request)
    {
        if ($request->campo) {
            $macs = Mac::where(
                $request->campo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $macs = Mac::all();
        }

        //dd($usuarios);
        return view('macList')->with(['macs' => $macs]);
    }
}
