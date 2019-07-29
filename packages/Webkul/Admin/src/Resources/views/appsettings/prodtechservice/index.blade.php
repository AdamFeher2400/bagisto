@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.prodtechservice.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.appsettings.prodtechservice.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.prodtechservice.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.appsettings.prodtechservice.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('prodtechservice','Webkul\Admin\DataGrids\ProdTechServiceDataGrid')
            {!! $prodtechservice->render() !!}
        </div>
    </div>
@stop