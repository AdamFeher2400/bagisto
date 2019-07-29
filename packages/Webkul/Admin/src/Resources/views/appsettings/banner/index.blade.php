@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.banner.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.appsettings.banner.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.banner.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.appsettings.banner.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('banner','Webkul\Admin\DataGrids\BannerDataGrid')
            {!! $banner->render() !!}
        </div>
    </div>
@stop