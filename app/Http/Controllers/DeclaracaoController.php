<?php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use App\Models\Comprovante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AlunoRepository;
use App\Repositories\DeclaracaoRepository;
use App\Repositories\ComprovanteRepository;

class DeclaracaoController extends Controller {
    
    protected $repository;

    public function __construct(){
        $this->repository = new DeclaracaoRepository();
    }

    public function index() {
        $data = $this->repository->selectAll();
        return $data;    
    }

    public function create() {
        // retorna, para o usuário, a view de criação de Comprovante
    }

    public function store(Request $request) {
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objComprovante = (new ComprovanteRepository())->findById($request->comprovante_id);   

        if(isset($objAluno) && isset($objComprovante)) {
            $obj = new Declaracao();
            $obj->hash = Hash::make($request->aluno_id + $request->comprovante_id);;
            $obj->data = date('Y-m-d H:i:s');
            $obj->aluno()->associate($objAluno);
            $obj->comprovante()->associate($objComprovante);
            $this->repository->save($obj);
            //$this->makeCertification($obj);
            return "<h1>Store - OK!</h1>";
        }
        
        return "<h1>Store - Not found Aluno or Comprovante!</h1>";
    }

    public function show(string $id) {
        $data = $this->repository->findById($id);
        return $data;
    }

    public function edit(string $id) {
        // $data = $this->repository->findById($id);
        // retorna, para o usuário, a view de edição de Comporvante - passa objeto $data
    }

    public function destroy(string $id) {

        if($this->repository->delete($id))  {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Turma!</h1>";
    }
}