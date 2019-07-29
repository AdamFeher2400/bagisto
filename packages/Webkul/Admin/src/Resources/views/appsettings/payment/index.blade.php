@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.payment.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.appsettings.payment.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.payment.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.appsettings.payment.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('payment','Webkul\Admin\DataGrids\PaymentDataGrid')
            {!! $payment->render() !!}
        </div>
    </div>
@stop