@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.cars.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.cars.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.catalog.cars.create') }}" class="btn btn-lg btn-primary">
                    {{ __('Add Car') }}
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.cars.list.before') !!}

        <div class="page-content">

            {!! app('Webkul\Admin\DataGrids\CarDataGrid')->render() !!}

        </div>

        {!! view_render_event('bagisto.admin.catalog.cars.list.after') !!}

    </div>
@stop