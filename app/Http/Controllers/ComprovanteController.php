<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\AlunoRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\ComprovanteRepository;
use App\Models\Comprovante;

class ComprovanteController extends Controller {

    protected $repository;

    public function __construct(){
        $this->repository = new ComprovanteRepository();
    }

    public function index() {
        $data = $this->repository->selectAll();
        return view('comprovante.index', compact('data'));  
    }

    public function create() {
        $alunos = (new AlunoRepository())->selectAll();
        $categorias = (new CategoriaRepository())->selectAll();
        $users = (new UserRepository())->selectAll();
        return view('comprovante.create', compact(['alunos', 'categorias', 'users']));   
    }

    public function store(Request $request) {
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objUser = (new UserRepository())->findById($request->user_id);
        
        if(isset($objCategoria) && isset($objAluno) && isset($objUser)) {
            $obj = new Comprovante();
            $obj->horas = $request->horas;
            $obj->atividade = mb_strtoupper($request->atividade, 'UTF-8');
            $obj->categoria()->associate($objCategoria);
            $obj->aluno()->associate($objAluno);
            $obj->user()->associate($objUser);
            $this->repository->save($obj);
            return redirect()->route('comprovante.index');
        }
        return view('message')
                ->with('template', "main")
                ->with('type', "danger")
                ->with('titulo', "OPERAÇÃO INVÁLIDA")
                ->with('message', "Não foi possível efetuar o procedimento!")
                ->with('link', "comprovante.index");
    }

    public function show(string $id) {
        $data = $this->repository->findById($id);
        return $data;
    }

    public function edit(string $id) {
        // $data = $this->repository->findById($id);
        // retorna, para o usuário, a view de edição de Comprovante - passa objeto $data
    }

    public function update(Request $request, string $id) {
        
        $obj = $this->repository->findById($id);
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objUser = (new UserRepository())->findById($request->user_id);
        
        if(isset($obj) && isset($objCategoria) && isset($objAluno) && isset($objUser)) {
            $obj->horas = $request->horas;
            $obj->atividade = mb_strtoupper($request->atividade, 'UTF-8');
            $obj->categoria()->associate($objCategoria);
            $obj->aluno()->associate($objAluno);
            $obj->user()->associate($objUser);
            $this->repository->save($obj);
            return "<h1>Update - OK!</h1>";
        }
        
        return "<h1>Store - Not found Categoria or Aluno or User!</h1>";
    }

    public function destroy(string $id) {
        
        if($this->repository->delete($id))  {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Aluno!</h1>";
    }
}