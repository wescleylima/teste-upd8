$(() => {

    if ($('#cpf').length) {
        $('#cpf').mask('000.000.000-00', {reverse: true});
    }

    if ($('#estado').length) {

        $.ajax({
            url: "/api/localidades/estados",
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $('#estado').empty();

                $('#estado').append('<option value="">Selecione uma UF</option>');

                var selected = $('#estado_select').val();

                $.each(res.data, function(key, value) {
                    $('#estado').append('<option value="' + value.sigla + '" ' + (selected==value.sigla ? 'selected' : '') + '>' + value.sigla + '</option>');
                });

                $('#estado').trigger('change');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar dados:', error);
            }
        });

        $('#cidade').attr('disabled', true);

        $('#estado').change(() => {
            var valorSelecionado = document.getElementById('estado').value;

            if (!valorSelecionado) {
                return false;
            }

            $.ajax({
                url: "/api/localidades/" + valorSelecionado + "/cidades",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#cidade').empty();

                    $('#cidade').append('<option value="">Selecione um item</option>');

                    var selected = $('#cidade_select').val();

                    $.each(res.data, function(key, value) {
                        $('#cidade').append('<option value="' + value.nome + '" ' + (selected==value.nome ? 'selected' : '') + '>' + value.nome + '</option>');
                    });
                    $('#cidade').attr('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao carregar dados:', error);
                }
            });
        });

    }
});
