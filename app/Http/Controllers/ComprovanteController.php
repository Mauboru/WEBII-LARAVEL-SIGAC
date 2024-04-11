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
        $data = $this->repository->findByIdWith(['categoria', 'aluno', 'user'], $id);
        if(isset($data))
            return view('comprovante.show', compact('data'));

        return view('message')
                    ->with('template', "main")
                    ->with('type', "danger")
                    ->with('titulo', "OPERAÇÃO INVÁLIDA")
                    ->with('message', "Não foi possível efetuar o procedimento!")
                    ->with('link', "curso.index");
    }

    public function edit(string $id) {
        $data = $this->repository->findById($id);

        if(isset($data)) {
            $alunos = (new AlunoRepository())->selectAll();
            $categorias = (new CategoriaRepository())->selectAll();
            $users = (new UserRepository())->selectAll();
            return view('comprovante.edit', compact(['data', 'alunos', 'categorias', 'users']));
        }
        return view('message')
                    ->with('template', "main")
                    ->with('type', "danger")
                    ->with('titulo', "OPERAÇÃO INVÁLIDA")
                    ->with('message', "Não foi possível efetuar o procedimento!")
                    ->with('link', "comprovante.index");
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
            return redirect()->route('comprovante.index');
        }
        
        return view('message')
                    ->with('template', "main")
                    ->with('type', "danger")
                    ->with('titulo', "OPERAÇÃO INVÁLIDA")
                    ->with('message', "Não foi possível efetuar o procedimento!")
                    ->with('link', "comprovante.index");
    }

    public function destroy(string $id) {
        if($this->repository->delete($id)) {
            return redirect()->route('comprovante.index');
        }
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "comprovante.index");
    }
}