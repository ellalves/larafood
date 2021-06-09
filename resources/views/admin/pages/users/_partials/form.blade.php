@csrf

<div class="form-group">
    <label for="name"> {{ __("Name") }}: </label>
    <input id="name" type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control" placeholder="{{ __("Name") }}:">
</div>

<div class="form-group">
    <label for="email"> {{ __("Email") }}: </label>
    <input id="email" type="text" name="email" value="{{ $user->email ?? old('email') }}" class="form-control" placeholder="{{ __("Email") }}:">
</div>

<div class="form-group">
    <label for="phone"> {{ __("Phone") }}: </label>
    <input id="phone" type="text" name="phone" value="{{ $user->phone ?? old('phone') }}" class="form-control" placeholder="{{ __("Phone") }}:">
</div>

<div class="form-group">
    <label for="email"> {{ __("Password") }}: </label>
    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="{{ __("Password") }}:">
</div>

@include('admin.includes.button_save')

@push('scripts')
<script src="{{ asset('js/jquery.inputmask.min.js')}}"></script>
<script>
    $(function () {
        $('#phone').inputmask('(99) 99999-9999', { 'placeholder': '(99) 99999-9999' })

        $("input[id*='cpfcnpj']").inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            keepStatic: true
        });
    });
</script>
@endpush