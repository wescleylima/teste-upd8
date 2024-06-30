<form action="{{ route('clientes.store') }}" method="post" id="form-search">

    @csrf

    <div class="form-group">

        <div class="row">

            <div class="row col-md-3">
                <label for="cpf" class="col-sm-3 label-form">CPF:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control required" id="cpf" name="cpf"
                        title="Digite um CPF válido (ex: 999.999.999-99)"
                        pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}">
                </div>
            </div>

            <div class="row col-md-3">
                <label for="nome" class="col-sm-3 label-form">Nome:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
            </div>

            <div class="row col-md-3">
                <label for="data_nascimento" class="col-sm-6 label-form">Data de Nasciento:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                </div>
            </div>

            <div class="row col-md-3">
                <label for="data_nascimento" class="col-sm-3 label-form">Sexo:</label>
                <div class="col-sm-9">
                    <input type="radio" class="form-check-input" name="sexo" id="sexo1" value="M">
                    <label class="label-option" for="sexo1">Masculino</label>
                    &nbsp;&nbsp;
                    <input type="radio" class="form-check-input" name="sexo" id="sexo2" value="F">
                    <label class="label-option" for="sexo2">Feminino</label>
                </div>
            </div>

        </div>

    </div>

    <br/>

    <div class="form-group">

        <div class="row">
            <div class="row col-md-3">
                <label for="nome" class="col-sm-3 label-form">Estado:</label>
                <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" id="estado" name="estado">
                        <option value="" selected>Selecione um estado...</option>
                    </select>
                </div>
            </div>

            <div class="row col-md-3">
                <label for="nome" class="col-sm-3 label-form">Cidade:</label>
                <div class="col-sm-9">
                    <select class="form-select" aria-label="Default select example" id="cidade" name="cidade">
                        <option value="" selected>Selecione uma cidade...</option>
                    </select>
                </div>
            </div>

            <div class="row col-md-6"></div>

        </div>

    </div>

    <div class="container mt-4">

        <div class="d-flex justify-content-end">

            <input type="button" value="Consultar" class="btn btn-primary" id="btn-consultar"/>
            &nbsp;
            <input type="reset" value="Limpar" class="btn btn-secondary" id="btn-limpar"/>

        </div>

    </div>

</form>
