@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="name"> Identificador: </label>
    <input type="text" name="name" value="{{ $table->name ?? old('name') }}" class="form-control" placeholder="Identificador:">
</div>

<div class="form-group">
    <label for="description"> Descrição: </label>
    <input type="text" name="description" value="{{ $table->description ?? old('description') }}" class="form-control" placeholder="Descrição:">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-info"> 
        <i class="fa fa-save"></i> Salvar 
    </button>
</div>