@extends('templates/main', ['titulo'=>$role])

@section('conteudo')
    <x-datatable 
        :title="$role"
        :header="['ID', 'Nome', 'Ações']" 
        crud="user" 
        :data="$data"
        :fields="['id', 'name']" 
        :hide="[true, false, false]"
        remove="name"
        :create="$route" 
        :id="$id"
        modal=""
    /> 
@endsection