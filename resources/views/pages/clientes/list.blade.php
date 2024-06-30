@extends('layouts.app')

@section('content')

    <div class="card">

        <div class="card-body">

            <h5 class="card-title title-form">Consulta Cliente</h5>

            <br/>

            @include('pages.clientes.forms.search')

        </div>
    </div>

    <br/>

    <div class="card">

        <div class="card-body">

            <h5 class="card-title title-list">Resultado da Pesquisa</h5>

            <br/>

            <table id="clientes-table" class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Cliente</th>
                        <th>CPF</th>
                        <th>Data Nasc.</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Sexo</th>
                    </tr>
                </thead>
            </table>

            <br />

            <div class="d-flex">
                <div class="mx-auto">
                    <ul id="infoPaginacao" class="pagination"></li>
                </div>
            </div>

        </div>
    </div>

@stop

@section('js')

    <script>

        $(() => {

            var dataTable = $('#clientes-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                info: false,
                ordering: false,
                ajax: {
                    url: "{{ route('clientes.index') }}",
                    type: 'GET',
                    data: function (d, a) {
                        d.page = (d.start / d.length) + 1;
                        d.estado = $('#estado').val();
                        d.cidade = $('#cidade').val();
                        d.nome = $('#nome').val();
                        d.sexo = $('[name=sexo]:checked').val();
                        d.cpf = $('#cpf').val();
                        d.data_nascimento = $('#data_nascimento').val();
                    },
                    dataSrc: function (json) {
                        json.page = json.current_page;
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        return json.data;
                    }
                },
                columns: [
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-success btn-sm btn-edit" data-id="' + data.id + '">Editar</button>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data.id + '">Excluir</button>';
                        }
                    },
                    { data: 'nome', name: 'nome' },
                    {
                        data: 'cpf',
                        name: 'cpf',
                        render: function(data) {
                            if (data) {
                                return data.toString().replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                            }
                            return data;
                        }
                    },
                    {
                        data: 'data_nascimento',
                        name: 'data_nascimento',
                        render: function(data) {
                            if (data) {
                                var regex = /^(\d{4})-(\d{2})-(\d{2})$/;
                                var match = regex.exec(data);
                                return match[3] + '/' + match[2] + '/' + match[1]
                            }
                            return '';
                        }
                    },
                    { data: 'estado', name: 'estado' },
                    { data: 'cidade', name: 'cidade' },
                    { data: 'sexo', name: 'sexo' },
                ],
                columnDefs: [
                    {
                        targets: [0,1,2,3,4,5,6,7],
                        className: 'text-center'
                    }
                ]
            }).on('draw', function() {
                atualizarInfoPaginacao();
            });

            function atualizarInfoPaginacao() {

                var pageInfo = dataTable.page.info();
                var currentPage = pageInfo.page + 1;
                var totalPages = Math.ceil(pageInfo.recordsTotal / pageInfo.length);
                var page, btnPagina, visiblePading, invervalPadding;

                $('#infoPaginacao').empty();

                for (var i = 0; i < totalPages; i++) {
                    page = (i + 1);
                    visiblePading = false;
                    if (
                        (currentPage>=totalPages-3 && page>=totalPages-4) ||
                        (currentPage<=4 && page<=5) ||
                        (page==1 || page==totalPages) ||
                        (page==currentPage || page==currentPage+1 || page==currentPage-1)
                        ) {

                        visiblePading = true;
                        invervalPadding = true;
                    }
                    if ((!visiblePading && invervalPadding==true)) {
                        btnPagina = $('<li>', {
                            html: '<span class="page-link">...</span>',
                            class: 'page-item'
                        });
                        $('#infoPaginacao').append(btnPagina);
                        invervalPadding = false;
                    }
                    btnPagina = $('<li>', {
                        html: '<a class="page-link" href="javascript:void(0)">' + page + '</a>',
                        class: 'page-item btn-pagina' + (visiblePading ? '' : ' d-none'),
                        click: function() {
                            var pagina = $(this).text() - 1;
                            dataTable.page(pagina).draw('page');
                        }
                    });
                    $('#infoPaginacao').append(btnPagina);
                }

                $('#infoPaginacao').find('.btn-pagina').eq(pageInfo.page).addClass('active');

                $('#infoPaginacao').prepend('<li class="page-item" id="btnPrimeira"><a class="page-link" href="javascript:void(0)">«</a></li>');
                $('#infoPaginacao').append('<li class="page-item" id="btnUltima"><a class="page-link" href="javascript:void(0)">»</a></li>');
                $('#infoPaginacao').prepend('<li class="page-item" id="btnAnterior"><a class="page-link" href="javascript:void(0)"><span class="fas fa-arrow-left"></span>&nbsp;Anterior</a></li>');
                $('#infoPaginacao').append('<li class="page-item" id="btnProxima"><a class="page-link" href="javascript:void(0)">Próxima&nbsp;<span class="fas fa-arrow-right"></span></a></li>');

                if (currentPage==1) {
                    $('#infoPaginacao #btnAnterior, #infoPaginacao #btnPrimeira').addClass('disabled');
                } else {
                    $('#infoPaginacao #btnAnterior').on('click', function() {
                        dataTable.page('previous').draw('page');
                    });
                    $('#infoPaginacao #btnPrimeira').on('click', function() {
                        dataTable.page('first').draw('page');
                    });
                }

                if (currentPage==totalPages) {
                    $('#infoPaginacao #btnUltima, #infoPaginacao #btnProxima').addClass('disabled');
                } else {
                    $('#infoPaginacao #btnUltima').on('click', function() {
                        dataTable.page('last').draw('page');
                    });
                    $('#infoPaginacao #btnProxima').on('click', function() {
                        dataTable.page('next').draw('page');
                    });
                }
            }

            $('#clientes-table_wrapper .dt-paging').remove();

            $('#btn-limpar').click(() => {

                document.getElementById('form-search').reset();
                dataTable.ajax.reload();
            });

            $('#btn-consultar').click(() => {
                dataTable.ajax.reload();
            });

            $('#clientes-table').on('click', '.btn-edit', function() {
                var clientId = $(this).data('id');
                var url = "{{ route('pages.clientes.edit', ['cliente' => ':clientId']) }}";
                url = url.replace(':clientId', clientId);
                document.location.href = url;
            });

            $('#clientes-table').on('click', '.btn-delete', function() {

                var confirmacao = confirm("Tem certeza que deseja excluir este cliente?");

                if (confirmacao) {

                    var clientId = $(this).data('id');
                    var url = "{{ route('clientes.destroy', ['cliente' => ':clientId']) }}";
                    url = url.replace(':clientId', clientId);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });

                    $.ajax({
                        url: url,
                        type: 'delete',
                        success: function(res) {
                            if (res.success) {
                                dataTable.ajax.reload();
                            }
                            alert(res.msg);
                        }
                    });
                }
            });

        });

    </script>

@stop

@section('css')

    <style>

        thead > tr {
            background-color: rgb(184, 184, 184);
        }

        thead > tr > th {
            background-color: gray;
            border: 1px solid black;
        }

        td {
            border: 1px solid black;
        }

        #btnProxima {
            margin-left: 15px;
        }

        #btnAnterior {
            margin-right: 15px;
        }

    </style>

@stop





