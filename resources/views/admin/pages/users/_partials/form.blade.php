@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="name"> Nome: </label>
    <input type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control" placeholder="Nome:">
</div>

<div class="form-group">
    <label for="email"> E-mail: </label>
    <input type="text" name="email" value="{{ $user->email ?? old('email') }}" class="form-control" placeholder="E-mail:">
</div>

<div class="form-group">
    <label for="email"> Senha: </label>
    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Preencha para alterar">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark"> Salvar </button>
</div>