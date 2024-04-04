@extends('templates/main', ['titulo'=>"ALUNOS"])

@section('conteudo')
    <x-datatable
        title="Tabela de Alunos" 
        :header="['ID', 'Nome', 'CPF', 'Email', 'Curso', 'Turma', 'Ações']" 
        crud="aluno" 
        :data="$data"
        :fields="['id', 'nome', 'cpf', 'email', 'curso_id', 'turma_id']" 
        :hide="[true, false, true, false, false, false, false]"
        remove="nome"
        create="aluno.create" 
        id=""
        modal=""
    />
@endsection