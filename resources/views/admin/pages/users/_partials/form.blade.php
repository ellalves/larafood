<form action="{{route('users.update', $user->id)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name"> {{ __('Name') }}: </label>
        <input id="name" type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control"
            placeholder="{{ __('Name') }}:">
    </div>
    <div class="form-group">
        <label for="username"> {{ __('Username') }}: </label>
        <input id="username" type="text" name="username" value="{{ $user->username ?? old('username') }}" class="form-control"
            placeholder="{{ __('Username') }}:">
    </div>

    <div class="form-group">
        <label for="cpfcnpj"> {{ __('Document') }}: </label>
        <input id="cpfcnpj" type="text" name="document" value="{{ $user->document ?? old('document') }}" class="form-control"
            placeholder="{{ __('Document') }}:">
    </div>

    <div class="form-group">
        <label for="email"> {{ __('Email') }}: </label>
        <input id="email" type="text" name="email" value="{{ $user->email ?? old('email') }}" class="form-control"
            placeholder="{{ __('Email') }}:">
    </div>

    <div class="form-group">
        <label for="sex"> {{ __('Sex') }}: </label>
        <select id="sex" name="sex" class="form-control">
            <option value="M" @if ($user->sex == 'M') checked @endif>
                {{ __('male') }} </option>
            <option value="F" @if ($user->sex == 'F') checked @endif>
                {{ __('female') }} </option>
        </select>
    </div>

    <div class="form-group">
        <label for="phone"> {{ __('Cellular phone') }}: </label>
        <input id="phone" type="text" name="phone" value="{{ $user->phone ?? old('phone') }}" class="form-control"
            placeholder="{{ __('Cellular phone') }}:">
    </div>

    <div class="form-group">
        <label for="birth"> {{ __('Birth') }}: </label>
        <input id="birth" type="text" name="birth" value="{{ $user->birth_date ?? old('birth') }}"
            class="form-control" placeholder="{{ __('Birth') }}:">
    </div>

    {{-- <div class="form-group">
        <label for="email"> {{ __('Password') }}: </label>
        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
            placeholder="{{ __('Password') }}:">
    </div> --}}

    <div class="form-group">
        <label for="bio"> {{ __('Bio') }}: </label>
        <textarea name="bio" id="bio" class="form-control">{{ $user->bio }}</textarea>
    </div>

    @include('admin.includes.button_save')
</form>

@push('scripts')
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            $('#phone').inputmask('(99) 99999-9999', {
                'placeholder': '(99) 99999-9999'
            })
            $('#birth').inputmask('99/99/9999', {
                'placeholder': '99/99/9999'
            })

            $("input[id*='cpfcnpj']").inputmask({
                mask: ['999.999.999-99', '99.999.999/9999-99'],
                keepStatic: true
            });
        });

    </script>
@endpush
