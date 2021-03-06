<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller {
    
    
    
    
    public function index() {
        
        $dados = Especialidade::all();
        $clinica = "VetClin DWII";

        // Passa um array "dados" com os "clientes" e a string "clínicas"
        return view('especialidades.index', compact(['dados', 'clinica']));
        // return view('cliente.index')->with('dados', $dados)->with('clinica', $clinica);
    }

    public function create() {

        return view('especialidades.create');
    }

   public function store(Request $request) {
        
        Especialidade::create([
        'nome' => mb_strtoupper($request->nome, 'UTF-8'),
        'descricao' => mb_strtoupper($request->descricao, 'UTF-8'),
        
    ]);
    
        return redirect()->route('especialidades.index');
    }

    public function show($id) {
        
         $dados = Especialidade::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('especialidades.show', compact('dados'));
    }

    public function edit($id) {

        $dados = Especialidade::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('especialidades.show', compact('dados'));     
    }

    public function update(Request $request, $id) {
        
        $aux = Especialidade::find($id);
        
       if(!isset($aux)){
        return "<h1> ID nao encontrado</h1>";
       }

        $aux->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'descricao' => mb_strtoupper($request->descricao, 'UTF-8'),

        ]);



        $aux -> save();
        

        return redirect()->route('especialidades.index');
    }

    public function destroy($id) {
        
        $aux = Especialidade::find($id);

        if(!isset($aux)){
            return "<h1> ID nao encontrado </h1>";
        }

        $aux -> destroy($id);

        
       

        return redirect()->route('especialidades.index');
    }
}
