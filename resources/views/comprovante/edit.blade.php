@extends('templates/main', ['titulo'=>"ALTERAR COMPROVANTE"])

@section('conteudo')
    <form action="{{ route('comprovante.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-textbox name="horas" label="Horas" type="text" :value="$data->horas" disabled="false"/>
        <x-textbox name="atividade" label="Atividade" type="text" :value="$data->atividade" disabled="false"/>
        <x-selectbox name="categoria_id" label="Categoria" color="success" :data="$categorias" field="nome" disabled="false" :select="$data->categoria_id"/>
        <x-selectbox name="aluno_id" label="Aluno" color="success" :data="$alunos" field="nome" disabled="false" :select="$data->aluno_id"/>
        <x-selectbox name="user_id" label="User" color="success" :data="$users" field="nome" disabled="false" :select="$data->user_id"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="comprovante.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Alterar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
@endsection