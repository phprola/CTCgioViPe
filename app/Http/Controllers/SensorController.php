<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sensores = Sensor::all();

        return view('sensorList')->with(['sensor' => $sensores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sensorForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required | max: 35',
                'temperatura' => 'required',
                'contador' => 'required',
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 35 caracteres',
                'temperatura.required' => 'A temperatura é obrigatória',
                'contador.required' => 'O contador é obrigatório',
            ]
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'nome' => $request->nome,
            'temperatura' => $request->temperatura,
            'contador' => $request->contador,
        ];

        //dd( $request->nome);
        //passa o vetor com os dados do formulário como parametro para ser salvo
        Sensor::create($dados);

        return \redirect('sensor')->with('success', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sensor = Sensor::findOrFail($id);

        return view('sensorForm')->with([
            'sensor' => $sensor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sensor = Sensor::findOrFail($id);

        return view('sensorForm')->with([
            'sensor' => $sensor,
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
                'temperatura' => 'required',
                'contador' => 'required',
            ],
            [
                'nome.required' => 'O nome é obrigatório',
                'nome.max' => 'Só é permitido 35 caracteres',
                'temperatura.required' => 'A temperatura é obrigatória',
                'contador.required' => 'O contador é obrigatório',
            ]
        );

        //adiciono os dados do formulário ao vetor
        $dados = [
            'nome' => $request->nome,
            'temperatura' => $request->temperatura,
            'contador' => $request->contador,
        ];

        //dd( $request->nome);
        //passa o vetor com os dados do formulário como parametro para ser salvo
        Sensor::updateOrCreate(
            ['id' => $request->id], $dados
        );

        return \redirect('sensor')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sensor = Sensor::findOrFail($id);

        $sensor->delete();

        return \redirect('sensor')->with('sucess', 'Removido com sucesso!');
    }

    function search(Request $request)
    {
        if ($request->campo) {
            $sensores = Sensor::where(
                $request->campo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $sensores = Sensor::all();
        }

        return view('sensorList')->with(['sensores' => $sensores]);
    }
}
