@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.essegroup.title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.essegroup.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>{{ __('admin::app.appsettings.essegroup.title') }}</h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.appsettings.essegroup.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">

                @csrf()
                
                <div class="panel-body">
                    <textarea id="tiny" class="control" id="add_content" name="content" rows="5">{{ $essegroup->content ? : old('content') }}</textarea>
                </div>

                <span class="control-error" v-if="errors.has('content')">@{{ errors.first('content') }}</span>
            </div>
        </form>

    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#tiny',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true,
                templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                ],
            });
        });
    </script>
@endpush