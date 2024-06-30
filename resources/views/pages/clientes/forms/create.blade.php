<h5 class="card-title title-form">Cadastro Cliente</h5>

<br/>

<form action="{{ route('clientes.store') }}" method="post" id="form-cliente">

    @csrf

    @include('pages.clientes.forms.cliente')

    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <input type="submit" value="Salvar" class="btn btn-primary"/>
            &nbsp;
            <input type="reset" value="Limpar" class="btn btn-secondary"/>
        </div>
    </div>

</form>

@section('js')

    <script>
        $(() => {
            $('#form-cliente').submit(() => {
                $.ajax({
                    url: "{{ route('clientes.store') }}",
                    type: "post",
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
