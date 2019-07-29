@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.cars.edit-title') }}
@stop

@section('content')
    <div class="content">
        <?php $locale = request()->get('locale') ?: app()->getLocale(); ?>

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.catalog.cars.edit-title') }}
                    </h1>

                    <div class="control-group">
                        <select class="control" id="locale-switcher" onChange="window.location.href = this.value">
                            @foreach (core()->getAllLocales() as $localeModel)

                                <option value="{{ route('admin.catalog.cars.update', $car->id) . '?locale=' . $localeModel->code }}" {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
                                    {{ $localeModel->name }}
                                </option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.catalog.cars.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.general.before', ['car' => $car]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.cars.general') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.general.controls.before', ['car' => $car]) !!}

                            <div class="control-group" :class="[errors.has('{{$locale}}[name]') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('admin::app.catalog.cars.name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="{{$locale}}[name]" value="{{ old($locale)['name'] ?: $car->translate($locale)['name'] }}" data-vv-as="&quot;{{ __('admin::app.catalog.cars.name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('{{$locale}}[name]')">@{{ errors.first('{!!$locale!!}[name]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                                <label for="status" class="required">{{ __('admin::app.catalog.cars.visible-in-menu') }}</label>
                                <select class="control" v-validate="'required'" id="status" name="status" data-vv-as="&quot;{{ __('admin::app.catalog.cars.visible-in-menu') }}&quot;">
                                    <option value="1" {{ $car->status ? 'selected' : '' }}>
                                        {{ __('admin::app.catalog.cars.yes') }}
                                    </option>
                                    <option value="0" {{ $car->status ? '' : 'selected' }}>
                                        {{ __('admin::app.catalog.cars.no') }}
                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('status')">@{{ errors.first('status') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('position') ? 'has-error' : '']">
                                <label for="position" class="required">{{ __('admin::app.catalog.cars.position') }}</label>
                                <input type="text" v-validate="'required|numeric'" class="control" id="position" name="position" value="{{ old('position') ?: $car->position }}" data-vv-as="&quot;{{ __('admin::app.catalog.cars.position') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('position')">@{{ errors.first('position') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.general.controls.after', ['car' => $car]) !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.general.after', ['car' => $car]) !!}


                    {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.description_images.before', ['car' => $car]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.cars.description-and-images') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.description_images.controls.before', ['car' => $car]) !!}

                            <div class="control-group" :class="[errors.has('display_mode') ? 'has-error' : '']">
                                <label for="display_mode" class="required">{{ __('admin::app.catalog.cars.display-mode') }}</label>
                                <select class="control" v-validate="'required'" id="display_mode" name="display_mode" data-vv-as="&quot;{{ __('admin::app.catalog.cars.display-mode') }}&quot;">
                                    <option value="products_and_description" {{ $car->display_mode == 'products_and_description' ? 'selected' : '' }}>
                                        {{ __('admin::app.catalog.cars.products-and-description') }}
                                    </option>
                                    <option value="products_only" {{ $car->display_mode == 'products_only' ? 'selected' : '' }}>
                                        {{ __('admin::app.catalog.cars.products-only') }}
                                    </option>
                                    <option value="description_only" {{ $car->display_mode == 'description_only' ? 'selected' : '' }}>
                                        {{ __('admin::app.catalog.cars.description-only') }}
                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('display_mode')">@{{ errors.first('display_mode') }}</span>
                            </div>

                            <description></description>

                            <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                                <label>{{ __('admin::app.catalog.cars.image') }}

                                <image-wrapper :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'" input-name="image" :multiple="false"  :images='"{{ $car->image_url }}"'></image-wrapper>

                                <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                    @foreach ($errors->get('image.*') as $key => $message)
                                        @php echo str_replace($key, 'Image', $message[0]); @endphp
                                    @endforeach
                                </span>

                            </div>

                            {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.description_images.controls.after', ['car' => $car]) !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.description_images.after', ['car' => $car]) !!}

                    @if ($cars->count())

                        {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.parent_car.before', ['car' => $car]) !!}

                        <accordian :title="'{{ __('admin::app.catalog.cars.parent-car') }}'" :active="true">
                            <div slot="body">

                                {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.parent_car.controls.before', ['car' => $car]) !!}

                                <tree-view value-field="id" name-field="parent_id" input-type="radio" items='@json($cars)' value='@json($car->parent_id)'></tree-view>

                                {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.parent_car.controls.before', ['car' => $car]) !!}

                            </div>
                        </accordian>

                        {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.parent_car.after', ['car' => $car]) !!}

                    @endif


                    {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.seo.before', ['car' => $car]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.cars.seo') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.seo.controls.before', ['car' => $car]) !!}

                            <div class="control-group">
                                <label for="meta_title">{{ __('admin::app.catalog.cars.meta_title') }}</label>
                                <input type="text" class="control" id="meta_title" name="{{$locale}}[meta_title]" value="{{ old($locale)['meta_title'] ?: $car->translate($locale)['meta_title'] }}"/>
                            </div>

                            <div class="control-group" :class="[errors.has('{{$locale}}[slug]') ? 'has-error' : '']">
                                <label for="slug" class="required">{{ __('admin::app.catalog.cars.slug') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="slug" name="{{$locale}}[slug]" value="{{ old($locale)['slug'] ?: $car->translate($locale)['slug'] }}" data-vv-as="&quot;{{ __('admin::app.catalog.cars.slug') }}&quot;" v-slugify/>
                                <span class="control-error" v-if="errors.has('{{$locale}}[slug]')">@{{ errors.first('{!!$locale!!}[slug]') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="meta_description">{{ __('admin::app.catalog.cars.meta_description') }}</label>
                                <textarea class="control" id="meta_description" name="{{$locale}}[meta_description]">{{ old($locale)['meta_description'] ?: $car->translate($locale)['meta_description'] }}</textarea>
                            </div>

                            <div class="control-group">
                                <label for="meta_keywords">{{ __('admin::app.catalog.cars.meta_keywords') }}</label>
                                <textarea class="control" id="meta_keywords" name="{{$locale}}[meta_keywords]">{{ old($locale)['meta_keywords'] ?: $car->translate($locale)['meta_keywords'] }}</textarea>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.seo.controls.after', ['car' => $car]) !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.car.edit_form_accordian.seo.after', ['car' => $car]) !!}

                </div>
            </div>

        </form>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script type="text/x-template" id="description-template">

        <div class="control-group" :class="[errors.has('{{$locale}}[description]') ? 'has-error' : '']">
            <label for="description" :class="isRequired ? 'required' : ''">{{ __('admin::app.catalog.cars.description') }}</label>
            <textarea v-validate="isRequired ? 'required' : ''" class="control" id="description" name="{{$locale}}[description]" data-vv-as="&quot;{{ __('admin::app.catalog.cars.description') }}&quot;">{{ old($locale)['description'] ?: $car->translate($locale)['description'] }}</textarea>
            <span class="control-error" v-if="errors.has('{{$locale}}[description]')">@{{ errors.first('{!!$locale!!}[description]') }}</span>
        </div>

    </script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#description',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true
            });
        });

        Vue.component('description', {

            template: '#description-template',

            inject: ['$validator'],

            data: function() {
                return {
                    isRequired: true,
                }
            },

            created: function () {
                var this_this = this;

                $(document).ready(function () {
                    $('#display_mode').on('change', function (e) {
                        if ($('#display_mode').val() != 'products_only') {
                            this_this.isRequired = true;
                        } else {
                            this_this.isRequired = false;
                        }
                    })

                    if ($('#display_mode').val() != 'products_only') {
                        this_this.isRequired = true;
                    } else {
                        this_this.isRequired = false;
                    }
                });
            }
        })
    </script>
@endpush