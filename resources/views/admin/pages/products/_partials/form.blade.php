@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="title"> Título: </label>
    <input type="text" name="title" value="{{ $product->title ?? old('title') }}" class="form-control" placeholder="Título:">
</div>

<div class="form-group">
    <label for="description"> Descrição: </label>
    <textarea name="description" class="form-control">{{ $product->description ?? old('description') }}</textarea>
</div>

<div class="form-group">
    <label for="price"> Preço: </label>
    <input type="text" name="price" value="{{ $product->price ?? old('price') }}" class="form-control" placeholder="Preço:">
</div>

<div class="form-group">
    <label for="image"> Imagem: </label>
    <div class="custom-file">
      <input type="file" name="image" class="custom-file-input" id="image">
      <label class="custom-file-label" for="image">Escolha uma imagem</label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-info"> 
        <i class="fa fa-save"></i> Salvar 
    </button>
</div>