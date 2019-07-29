@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.contact.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.contact.create') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.appsettings.contact.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.appsettings.contact.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name">{{ __('admin::app.appsettings.contact.name') }}</label>
                        <input type="text" class="control" name="name" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.contact.name') }}&quot;">
                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('address') ? 'has-error' : '']">
                        <label for="address">{{ __('admin::app.appsettings.contact.address') }}</label>
                        <input type="text" class="control" name="address" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.contact.address') }}&quot;">
                        <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('tel') ? 'has-error' : '']">
                        <label for="tel">{{ __('admin::app.appsettings.contact.tel') }}</label>
                        <input type="text" class="control" name="tel" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.contact.tel') }}&quot;">
                        <span class="control-error" v-if="errors.has('tel')">@{{ errors.first('tel') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('fax') ? 'has-error' : '']">
                        <label for="fax">{{ __('admin::app.appsettings.contact.fax') }}</label>
                        <input type="text" class="control" name="fax" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.contact.fax') }}&quot;">
                        <span class="control-error" v-if="errors.has('fax')">@{{ errors.first('fax') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('domain') ? 'has-error' : '']">
                        <label for="domain">{{ __('admin::app.appsettings.contact.domain') }}</label>
                        <input type="text" class="control" name="domain" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.contact.domain') }}&quot;">
                        <span class="control-error" v-if="errors.has('domain')">@{{ errors.first('domain') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email">{{ __('admin::app.appsettings.contact.email') }}</label>
                        <input type="text" class="control" name="email" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.contact.email') }}&quot;">
                        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

