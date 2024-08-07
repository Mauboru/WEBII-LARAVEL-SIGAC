<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DocumentoRepository;
use App\Repositories\CategoriaRepository;
use App\Models\Documento;

class DocumentoController extends Controller {
    protected $repository;

    public function __construct(){
        $this->repository = new DocumentoRepository();
    }

    public function index() {
        $data = $this->repository->selectAll();
        return view('documento.index', compact('data'));  
    }

    public function create() {
        // $this->authorize('hasFullPermission', Documento::class);
        $categorias = (new CategoriaRepository())->selectAll();
        return view('documento.create', compact(['categorias']));
    }

    public function store(Request $request) {
        // $this->authorize('hasFullPermission', Documento::class);
        // // Registra o Evento HourRegister
        // event(
        //     new HourRegister(
        //         Auth::user(),
        //         $request->categoria_id,
        //         mb_strtoupper($request->descricao, 'UTF-8'),
        //         $request->horas,
        //     )
        // );
        
        // $request->validate($this->rules, $this->messages);
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        // $objUser = (new UserRepository())->findById(Auth::user()->id);

        if($request->hasFile('documento') && isset($objCategoria) /*&& isset($objUser)*/) {
            // Registra a Solicitação
            $obj = new Documento();
            $obj->descricao = mb_strtoupper($request->descricao, 'UTF-8');
            $obj->horas_in = $request->horas;
            $obj->status = 0;
            $obj->categoria()->associate($objCategoria);
            // $obj->user()->associate($objUser);
            $id = $this->repository->saveAndReturnId($obj);    
            // Efetua o Upload do Documento
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $id.'_'.time().'.'.$extensao_arq;
            $request->file('documento')->storeAs("public/$this->path", $nome_arq);
            $obj->url = $this->path."/".$nome_arq;
            $this->repository->save($obj);
            return redirect()->route('documento.index');    
        }

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "documento.index");
    }

    public function destroy(string $id) {
        if($this->repository->delete($id))  {
            return redirect()->route('documento.index');
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "documento.index");
    }
}