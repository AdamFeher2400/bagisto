@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.prodtechservice.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.prodtechservice.create') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.appsettings.prodtechservice.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.appsettings.prodtechservice.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    <div class="control-group" :class="[errors.has('customer_id') ? 'has-error' : '']">
                        <label for="type" class="required">{{ __('admin::app.appsettings.prodtechservice.customer') }}</label>
                        <select class="control" v-validate="'required'" id="customer_id" name="customer_id" data-vv-as="&quot;{{ __('admin::app.appsettings.prodtechservice.customer') }}&quot;">
                            @foreach($customers as $key => $customer)
                                <option value="{{ $customer['id'] }}" {{ $key == $customer['key'] ? 'selected' : '' }}>{{ $customer['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="control-group" :class="[errors.has('brand') ? 'has-error' : '']">
                        <label for="brand" class="required">{{ __('admin::app.appsettings.prodtechservice.brand') }}</label>
                        <input type="text" class="control" name="brand" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.prodtechservice.brand') }}&quot;">
                        <span class="control-error" v-if="errors.has('brand')">@{{ errors.first('brand') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('model') ? 'has-error' : '']">
                        <label for="model" class="required">{{ __('admin::app.appsettings.prodtechservice.model') }}</label>
                        <input type="text" class="control" name="model" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.appsettings.prodtechservice.model') }}&quot;">
                        <span class="control-error" v-if="errors.has('model')">@{{ errors.first('model') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('arrival') ? 'has-error' : '']">
                        <label for="arrival">{{ __('admin::app.appsettings.prodtechservice.arrival') }}</label>
                        <input type="date" class="control" name="arrival" data-vv-as="&quot;{{ __('admin::app.appsettings.prodtechservice.arrival') }}&quot;">
                        <span class="control-error" v-if="errors.has('arrival')">@{{ errors.first('arrival') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('return') ? 'has-error' : '']">
                        <label for="return">{{ __('admin::app.appsettings.prodtechservice.return') }}</label>
                        <input type="date" class="control" name="return" data-vv-as="&quot;{{ __('admin::app.appsettings.prodtechservice.return') }}&quot;">
                        <span class="control-error" v-if="errors.has('return')">@{{ errors.first('return') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                        <label for="type" class="required">{{ __('admin::app.appsettings.prodtechservice.status') }}</label>
                        <select class="control" v-validate="'required'" id="status" name="status" data-vv-as="&quot;{{ __('admin::app.appsettings.prodtechservice.status') }}&quot;">
                            @foreach($statuses as $key => $status)
                                <option value="{{ $status['name'] }}" {{ $key == $status['key'] ? 'selected' : '' }}>{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="control-group" :class="[errors.has('techservice_id') ? 'has-error' : '']">
                        <label for="type" class="required">{{ __('admin::app.appsettings.prodtechservice.techservice') }}</label>
                        <select class="control" v-validate="'required'" id="techservice_id" name="techservice_id" data-vv-as="&quot;{{ __('admin::app.appsettings.prodtechservice.techservice') }}&quot;">
                            @foreach($techservices as $key => $techservice)
                                <option value="{{ $techservice['id'] }}" {{ $key == $techservice['key'] ? 'selected' : '' }}>{{$techservice['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

