@extends('templates/main', ['titulo'=>"DETALHES DO NIVEL"])

@section('conteudo')
    <x-textbox name="nome" label="Nome" type="text" value="{{$data->nome}}" disabled="true"/>
    <div class="row">
        <div class="col text-start">
            <x-button label="Voltar" type="link" route="nivel.index" color="secondary"/>
        </div>
    </div>
@endsection