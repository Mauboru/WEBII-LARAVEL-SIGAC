@extends('templates/main', ['titulo'=>"DETALHES DO COMPROVANTE"])

@section('conteudo')
    <x-textbox name="horas" label="Horas" type="hours" value="{{$data->horas}}" disabled="true"/>
    <x-textbox name="atividade" label="Atividade" type="text" value="{{$data->atividade}}" disabled="true"/>
    <x-textbox name="categoria_id" label="Categoria" type="text" value="{{$data->categoria_id}}" disabled="true"/>
    <x-textbox name="aluno_id" label="Aluno" type="text" value="{{$data->aluno_id}}" disabled="true"/>
    <x-textbox name="user_id" label="User" type="text" value="{{$data->user_id}}" disabled="true"/>
    <div class="row">
        <div class="col text-start">
            <x-button label="Voltar" type="link" route="comprovante.index" color="secondary"/>
        </div>
    </div>
@endsection