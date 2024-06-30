<div class="form-group">
    <div class="row">
        <div class="row col-md-3">
            <label for="cpf" class="col-sm-3 label-form">CPF:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control required" id="cpf" name="cpf"
                    value="{{ $cliente->cpf ?? '' }}"
                    title="Digite um CPF válido (ex: 999.999.999-99)"
                    pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}"
                    required>
            </div>
        </div>
        <div class="row col-md-3">
            <label for="nome" class="col-sm-3 label-form">Nome:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome ?? '' }}" required>
            </div>
        </div>
        <div class="row col-md-3">
            <label for="data_nascimento" class="col-sm-7 label-form">Data de Nasciento:</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{ $cliente->data_nascimento ?? '' }}">
            </div>
        </div>
        <div class="row col-md-3">
            <label for="data_nascimento" class="col-sm-3 label-form">Sexo:</label>
            <div class="col-sm-9">
                <input type="radio" class="form-check-input" name="sexo" id="sexo1" value="M" {{ isset($cliente->sexo) && $cliente->sexo=='M' ? 'checked' : '' }}>
                <label class="label-option" for="sexo1">Masculino</label>
                &nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="sexo" id="sexo2" value="F" {{ isset($cliente->sexo) && $cliente->sexo=='F' ? 'checked' : '' }}>
                <label class="label-option" for="sexo2">Feminino</label>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="form-group">
    <div class="row">
        <div class="row col-md-6">
            <label for="nome" class="col-sm-2 label-form">Endereço:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $cliente->endereco ?? '' }}" required>
            </div>
        </div>
        <div class="row col-md-3">
            <label for="nome" class="col-sm-4 label-form">Estado:</label>
            <div class="col-sm-8">
                <select class="form-select" aria-label="Default select example" id="estado" name="estado" value="{{ $cliente->estado ?? '' }}" required>
                    <option value="" selected>Selecione uma UF...</option>
                    <option value="DF">DF</option>
                </select>
                <input type="hidden" name="estado_select" id="estado_select" value="{{ $cliente->estado ?? '' }}">
            </div>
        </div>
        <div class="row col-md-3">
            <label for="nome" class="col-sm-4 label-form">Cidade:</label>
            <div class="col-sm-8">
                <select class="form-select" aria-label="Default select example" id="cidade" name="cidade" required>
                    <option selected>Selecione uma cidade...</option>
                </select>
                <input type="hidden" name="cidade_select" id="cidade_select" value="{{ $cliente->cidade ?? '' }}">
            </div>
        </div>
    </div>
</div>
