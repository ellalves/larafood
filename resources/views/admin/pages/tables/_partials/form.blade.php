@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="identify"> Identificador: </label>
    <input type="text" name="identify" value="{{ $table->identify ?? old('identify') }}" class="form-control" placeholder="Identificador:">
</div>

<div class="form-group">
    <label for="description"> Descrição: </label>
    <input type="text" name="description" value="{{ $table->description ?? old('description') }}" class="form-control" placeholder="Descrição:">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark"> 
        <i class="fa fa-save"></i> Salvar 
    </button>
</div>