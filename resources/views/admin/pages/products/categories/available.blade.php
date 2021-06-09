@extends('adminlte::page')

@section('title', __("Categories available for the product") . ': ' . $product->title)

@section('content_header')
    {{ Breadcrumbs::render('productsCategoriesAvailable', $product) }}
    <h1> {{ __("Categories available for the product") }}: <strong>{{ $product->title }}</strong>
@stop

@section('content')
    <div class="card">

        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('products.categories.available', $product->id)
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
                <tbody>
                    <form action="{{ route('products.categories.attach', $product->id)}}" method="post">
                        @csrf
                        <tr class="row mx-0">
                            @foreach ($categories as $category)
                                <td class="align-middle">
                                    <div class="form-group col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <div class="custom-control custom-switch custom-switch-on-success">
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="custom-control-input" id="{{ $category->id }}">
                                            <label class="custom-control-label" for="{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    </div>

                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="align-middle">
                                @if (count($categories) > 0)
                                    @include('admin.includes.button_save', [
                                        'btnIcon' => 'link',
                                        'btnSave' => __('Link'),
                                    ])
                                @else
                                    @include('admin.includes.alerts_messages', ['msg' => __('messages.no_options_available') ])
                                @endif
                            </td>
                        </tr>                      
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $categories->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
@stop