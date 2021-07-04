@csrf

<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col kv-avatar">
                <div class="file-loading">
                    <input id="avatar-1" name="image" type="file">
                </div>
            </div>
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>

        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label for="title"> {{ __('Title') }}: </label>
            <input type="text" name="title" value="{{ $product->title ?? old('title') }}" class="form-control"
                placeholder="{{ __('Title') }}:">
        </div>

        <div class="form-group">
            <label for="description"> {{ __('Description') }}: </label>
            <textarea name="description" placeholder="{{ __('Description') }}:"
                class="form-control">{{ $product->description ?? old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="price"> {{ __('Price') }}: </label>
            <input id="moedaReal" type="tel" name="price" value="{{ $product->price ?? old('price') }}"
                class="form-control" placeholder="{{ __('Price') }}:">
        </div>

        @include('admin.includes.button_save')
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            $('#moedaReal').inputmask('decimal', {
                radixPoint: ".",
                groupSeparator: ",",
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                placeholder: '0',
                rightAlign: false,
                onBeforeMask: function(value, opts) {
                    return value;
                }
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
            showRemove: true,
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
            defaultPreviewContent: '<img src="{{ !empty($product->image) ? url("storage/$product->image") : url('images/company_none.png') }}" class="img-fluid" alt="{{ __('Image') }}"><h6 class = "text-muted"> {{ !empty($product->image) ? __('Click to change your image') : __('Click to select your image') }} </h6>',
            layoutTemplates: {
                main2: '{preview} {remove} {browse}'
            },
            allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
        });

    </script>
@endpush
