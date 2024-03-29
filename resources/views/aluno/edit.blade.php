@extends('templates/main', ['titulo'=>"ALTERAR ALUNO"])

@section('conteudo')
    <form action="{{ route('aluno.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-textbox name="nome" label="Nome" type="text" :value="$data->nome" disabled="false"/>
        <x-textbox name="cpf" label="CPF" type="number" :value="$data->cpf" disabled="false"/>
        <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false" :select="$data->curso_id"/>
        <x-selectbox name="turma_id" label="Turma" color="success" :data="$turmas" field="ano" disabled="true" :select="$data->turma_id"/>
        <div class="row">
            <div class="col text-start">
                <x-button label="Voltar" type="link" route="aluno.index" color="secondary"/>
            </div>
            <div class="col text-end">
                <x-button label="Alterar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        document.getElementById('curso_id').addEventListener('change', function() {
            let curso_id = this.value

            $.getJSON('/api/turma/'+curso_id, function(data) {
                $('#turma_id').children().remove().end()
                data.map((item) => {
                    $('#turma_id').append(new Option(item.ano, item.id))
                });
                $('#turma_id').removeAttr('disabled');
            });
            // $('#id').attr('disabled', 'disabled');  
        });
    </script>
@endsection