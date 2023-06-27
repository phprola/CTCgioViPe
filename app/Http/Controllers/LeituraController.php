<?php

namespace App\Http\Controllers;

use App\Models\Leitura;
use Illuminate\Http\Request;

class LeituraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leituras = Leitura::all();

        return view('LeituraList')->with(['leituras' => $leituras]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('LeituraForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'dataLeitura' => 'required',
                'horaLeitura' => 'required',
                'valorSensor' => 'required',
            ],
            [
                'dataLeitura.required' => 'A data da leitura é obrigatório',
                'horaLeitura.required' => 'A hora da leitura é obrigatório',
                'valorSensor.required' => 'O valor do sensor é obrigatório',
            ]
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'dataLeitura' => $request->dataLeitura,
            'horaLeitura' => $request->horaLeitura,
            'valorSensor' => $request->valorSensor,
        ];

        //dd( $request->nome);
        //passa o vetor com os dados do formulário como parametro para ser salvo
        Leitura::create($dados);

        return \redirect('leitura')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leitura = Leitura::findOrFail($id);

        return view('leituraForm')->with([
            'leitura' => $leitura,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leitura = Leitura::findOrFail($id);

        return view('leituraForm')->with([
            'leitura' => $leitura,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'dataLeitura' => 'required',
                'horaLeitura' => 'required',
                'valorSensor' => 'required',
            ],
            [
                'dataLeitura.required' => 'A data da leitura é obrigatório',
                'horaLeitura.required' => 'A hora da leitura é obrigatório',
                'valorSensor.required' => 'O valor do sensor é obrigatório',
            ]
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'dataLeitura' => $request->dataLeitura,
            'horaLeitura' => $request->horaLeitura,
            'valorSensor' => $request->valorSensor,
        ];

        //dd( $request->nome);
        //passa o vetor com os dados do formulário como parametro para ser salvo
        Leitura::updateOrCreate(
            ['id' => $request->id], $dados
        );

        return \redirect('leitura')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leitura = Leitura::findOrFail($id);

        // verifica se existe o arquivo vinculado ao registro e depois remove
        $leitura->delete();
        return \redirect('leitura')->with('success', 'Removido com sucesso!');
    }

    function search(Request $request)
    {
        if ($request->campo) {
            $leituras = Leitura::where(
                $request->campo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $leituras = Leitura::all();
        }

        //dd($usuarios);
        return view('leituraList')->with(['leituras' => $leituras]);
    }
}
