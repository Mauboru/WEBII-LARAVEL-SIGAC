@extends('templates/site')

@section('conteudo')
    <form action="{{ route('site.register') }}" method="POST">
        @csrf
        <h2 class="text-success fw-bold">REGISTRO DO ALUNO</h2>
        <x-textbox name="nome" label="Nome" type="text" value="null" disabled="false"/>
        <x-textbox name="cpf" label="CPF" type="number" value="null" disabled="false"/>
        <x-textbox name="email" label="E-mail" type="email" value="null" disabled="false"/>
        <x-textbox name="senha" label="Senha" type="password" value="null" disabled="false"/>
        <x-textbox name="confirmacao" label="Confirmar" type="password" value="null" disabled="false"/>
        <x-selectbox name="curso_id" label="Curso" color="success" :data="$cursos" field="nome" disabled="false" select="-1"/>
        <x-selectbox name="turma_id" label="Turma" color="success" :data="$turmas" field="ano" disabled="true" select="-1"/>
        <div class="d-flex justify-content-end">
            <x-button label="Registrar" type="submit" route="" color="success"/>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        document.getElementById('curso_id').addEventListener('change', function() {
            let curso_id = this.value

            $.getJSON('/api/turma/'+curso_id, function(data) {
                $('#turma_id').children().remove().end();

                data.map((item) => {
                    $('#turma_id').append(new Option(item.ano, item.id));
                });

                $('#turma_id').removeAttr('disabled');
            });
            //$('#id').attr('enable', 'disabled');  
        });
    </script>
@endsection