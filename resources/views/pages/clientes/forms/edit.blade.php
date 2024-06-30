<h5 class="card-title title-form">Alterar Cliente</h5>

<br/>

<form action="{{ route('clientes.update', ['cliente' => $cliente->id]) }}" method="put" id="form-cliente">

    @csrf

    <input type="hidden" name="id_cliente" id="id_cliente" value="{{ $cliente->id ?? '' }}">

    @include('pages.clientes.forms.cliente')

    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <input type="submit" value="Salvar" class="btn btn-primary"/>
            &nbsp;
            <input type="reset" value="Cancelar" class="btn btn-danger" onclick="javascript:history.back(-1)"/>
        </div>
    </div>

</form>

@section('js')

    <script>
        $(() => {
            $('#cpf').attr('readonly', true);
            $('#form-cliente').submit(() => {
                var clientId = $('#id_cliente').val();
                var url = "{{ route('clientes.update', ['cliente' => ':clientId']) }}";
                url = url.replace(':clientId', clientId);
                $.ajax({
                    url: url,
                    type: "put",
                    data: $("#form-cliente").serialize(),
                    success: function(res) {
                        alert(res.msg);
                        if (res.success) {
                            document.location.href = "{{ route('pages.clientes.list') }}";
                        }
                    }
                });

                return false;
            });
        });
    </script>

@stop
