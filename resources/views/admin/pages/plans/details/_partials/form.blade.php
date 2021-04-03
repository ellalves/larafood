@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input id="name" type="text" name="name" value="{{ $detail->name ?? old('name') }}" placeholder="Nome" class="form-control">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>