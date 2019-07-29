@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.techservice.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.appsettings.techservice.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.techservice.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.appsettings.techservice.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('techservice','Webkul\Admin\DataGrids\TechServiceDataGrid')
            {!! $techservice->render() !!}
        </div>
    </div>
@stop