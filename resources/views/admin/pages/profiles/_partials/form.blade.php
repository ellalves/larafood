@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="name"> Nome: </label>
    <input type="text" name="name" value="{{ $profile->name ?? old('name') }}" class="form-control" placeholder="Nome:">
</div>

<div class="form-group">
    <label for="description"> Descrição: </label>
    <input type="text" name="description" value="{{ $profile->description ?? old('description') }}" class="form-control" placeholder="Descrição:">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark"> Salvar </button>
</div>