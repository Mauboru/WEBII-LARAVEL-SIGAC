@extends('templates/main', ['titulo'=>"EIXO"])
@section('conteudo')

    <x-datatable 
        title="Tabela de Eixos" 
        :header="['ID', 'Nome', 'Ações']" 
        crud="curso" 
        :data="$data"
        :fields="['id', 'nome']" 
        :hide="[true, false, false]"
        remove="nome"
        create="eixo.create" 
        id=""
        modal=""
    /> 
@endsection