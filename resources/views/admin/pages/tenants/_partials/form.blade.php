@csrf

<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col kv-avatar">
                <div class="file-loading">
                    <input id="avatar-1" name="logo" type="file">
                </div>
            </div>
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>

        </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <label for="plan_id"> {{ __('Plan') }} *: </label>
            <select name="plan_id" id="plan_id" class="form-control js-basic-single" @if (!empty($tenant)) disabled @endif>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}"> {{ $plan->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name"> {{ __('Name of responsible') }} *: </label>
            <input id="name" type="text" name="name" value="{{ $tenant->name ?? old('name') }}" class="form-control"
                placeholder="{{ __('Name of responsible') }} *:" @if (!empty($tenant)) disabled @endif>
        </div>

        <div class="form-group">
            <label for="name"> {{ __('Company name') }} *: </label>
            <input type="text" name="company" value="{{ $tenant->name ?? old('company') }}" class="form-control"
                placeholder="{{ __('Company name') }} *:">
        </div>

        <div class="form-group">
            <label for="document"> {{ __('Document') }} *: </label>
            <input id="document" type="tel" name="document" value="{{ $tenant->document ?? old('document') }}"
                class="form-control" placeholder="{{ __('CPF or CNPJ') }} *:">
        </div>

        <div class="form-group">
            <label for="phone"> {{ __('Cellular phone') }} *: </label>
            <input id="phone" type="tel" name="phone" value="{{ $tenant->phone ?? old('phone') }}"
                class="form-control phone_with_ddd" placeholder="{{ __('Cellular phone') }} *:" id="datemask">
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="email"> {{ __('Email') }} *: </label>
        <input id="email" type="text" name="email" value="{{ $tenant->email ?? old('email') }}" class="form-control"
            placeholder="{{ __('Email') }} *:">
    </div>

    <div class="form-group col-md-12">
        <label for="about">{{ __('About') }} *:</label>
        <textarea name="bio" placeholder="{{ __('Brief description about your company') }}" id="about"
            class="form-control"></textarea>
    </div>

    <div class="form-group col-md-12">
        <label for="active">{{ __('Active') }} *:</label>
        <select id="active" name="active" class="form-control">
            <option value="Y" @if (isset($tenant) && $tenant->active == 'Y') selected @endif>{{ __('yes') }}</option>
            <option value="N" @if (isset($tenant) && $tenant->active == 'N') selected @endif>{{ __('no') }}</option>
        </select>
    </div>

    <div class="col-md-12">
        @include('admin.includes.button_save')
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            $('#phone').inputmask('(99) 99999-9999', {
                'placeholder': '(99) 99999-9999'
            })

            $("input[id*='document']").inputmask({
                mask: ['999.999.999-99', '99.999.999/9999-99'],
                keepStatic: true
            });
        });

    </script>


    <!-- bootstrap 5.x and 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
    <!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you 
        wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/plugins/piexif.min.js"
        type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
        This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/plugins/sortable.min.js"
        type="text/javascript"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
       3.3.x versions without popper.min.js. -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. Bootstrap 5.x and 4.x is supported. You can also use the 3.3.x versions. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- the main fileinput plugin file -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/fileinput.min.js"></script>
    <!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/themes/fa/theme.js"></script>
    <!-- optionally if you need translation for your language then include  locale file as mentioned below (replace LANG.js with your locale file) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/locales/LANG.js"></script>

    <!-- the fileinput plugin initialization -->
    <script>
        $("#avatar-1").fileinput({
            idioma: "pt-Br",
            theme: "fa",
            overwriteInitial: false,
            maxFileSize: 1500,
            maxFileCount: 1,
            showClose: false,
            showRemove: false,
            showCaption: false,
            showBrowse: false,
            browseOnZoneClick: true,
            browseLabel: '',
            removeLabel: '',
            initialPreviewAsData: true,
            browseIcon: '<i class="fas fa-folder-open"></i>',
            removeIcon: '<i class="fas fa-times"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="{{ !empty($tenant->logo) ? url("storage/$tenant->logo") : url('images/company_none.png') }}" class="img-fluid" alt="{{ __('Logo') }}"><h6 class = "text-muted"> {{ !empty($tenant->logo) ? __('Click to change your logo') : __('Click to select your logo') }} </h6>',
            layoutTemplates: {
                main2: '{preview} {remove} {browse}'
            },
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

    </script>
@endpush
