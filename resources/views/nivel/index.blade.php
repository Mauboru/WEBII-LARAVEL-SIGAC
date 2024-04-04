@extends('templates/main', ['titulo'=>"NIVEL"])
@section('conteudo')

    <x-datatable 
        title="Tabela de Niveis" 
        :header="['ID', 'Nome', 'Ações']" 
        crud="nivel" 
        :data="$data"
        :fields="['id', 'nome']" 
        :hide="[true, false, false]"
        remove="nome"
        create="nivel.create" 
        id=""
        modal=""
    /> 
@endsection