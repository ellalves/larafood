@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="name"> Nome: </label>
    <input type="text" name="name" value="{{ $plan->name ?? old('name') }}" class="form-control" placeholder="Nome:">
</div>

<div class="form-group">
    <label for="period">Período</label>
    <select name="period" class="form-control" id="period">
        <option value="month">Mês</option>
        <option value="trimester">Trimestre</option>
        <option value="semester">Semestre</option>
        <option value="year">Ano</option>
    </select>
</div>

<div class="form-group">
    <label for="price"> Preço: </label>
    <input type="text" name="price" value="{{ $plan->price ?? old('price') }}" class="form-control"
        placeholder="Preço:">
</div>

<div class="form-group">
    <label for="description"> Descrição: </label>
    <input type="text" name="description" value="{{ $plan->description ?? old('description') }}" class="form-control"
        placeholder="Descrição:">
</div>

<div class="form-group">
    <label for="strip_id"> Identificador do plano no stripe: </label>
    <input type="text" name="stripe_id" value="{{ $plan->stripe_id ?? old('stripe_id') }}" class="form-control"
        placeholder="Identificador do plano no stripe">
</div>

<div class="form-group">
    <label for="yes">Recomendado</label>
    <div class="custom-control custom-radio">
        <input type="radio" name="recommended" value="1" @if (!empty($plan->recommended)) checked @endif class="custom-control-input" id="yes">
        <label for="yes" class="custom-control-label">Sim</label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" name="recommended" value="0" @if (empty($plan->recommended)) checked @endif class="custom-control-input" id="no">
        <label for="no" class="custom-control-label">Não</label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-info">
        <i class="fa fa-save"></i> Salvar
    </button>
</div>
