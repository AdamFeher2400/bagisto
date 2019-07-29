@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.techservice.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.techservice.create') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.appsettings.techservice.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.appsettings.techservice.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name">{{ __('admin::app.appsettings.techservice.name') }}</label>
                        <input type="text" class="control" name="name" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.techservice.name') }}&quot;">
                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('address') ? 'has-error' : '']">
                        <label for="address">{{ __('admin::app.appsettings.techservice.address') }}</label>
                        <input type="text" class="control" name="address" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.techservice.address') }}&quot;">
                        <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('tel') ? 'has-error' : '']">
                        <label for="tel">{{ __('admin::app.appsettings.techservice.tel') }}</label>
                        <input type="text" class="control" name="tel" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.techservice.tel') }}&quot;">
                        <span class="control-error" v-if="errors.has('tel')">@{{ errors.first('tel') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('mobile') ? 'has-error' : '']">
                        <label for="mobile">{{ __('admin::app.appsettings.techservice.mobile') }}</label>
                        <input type="text" class="control" name="mobile" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.techservice.mobile') }}&quot;">
                        <span class="control-error" v-if="errors.has('mobile')">@{{ errors.first('mobile') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('country') ? 'has-error' : '']">
                        <label for="country">{{ __('admin::app.appsettings.techservice.country') }}</label>
                        <input type="text" class="control" name="country" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.techservice.country') }}&quot;">
                        <span class="control-error" v-if="errors.has('country')">@{{ errors.first('country') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('city') ? 'has-error' : '']">
                        <label for="city">{{ __('admin::app.appsettings.techservice.city') }}</label>
                        <input type="text" class="control" name="city" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.techservice.city') }}&quot;">
                        <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

