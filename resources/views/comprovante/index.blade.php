@extends('templates/main', ['titulo'=>"COMPROVANTES"])

@section('conteudo')
    <x-datatable
        title="Tabela de Comprovantes" 
        :header="['ID', 'Horas', 'Atividade', 'Categoria', 'Aluno', 'User', 'Ações']" 
        crud="comprovante" 
        :data="$data"
        :fields="['id', 'horas', 'atividade', 'categoria_id', 'aluno_id', 'user_id']" 
        :hide="[true, false, false, false, false, false, false]"
        remove="horas"
        create="comprovante.create" 
        id=""
        modal=""
    />
@endsection