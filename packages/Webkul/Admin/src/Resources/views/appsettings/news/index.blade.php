@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.news.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.appsettings.news.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.news.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.appsettings.news.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('news','Webkul\Admin\DataGrids\NewsDataGrid')
            {!! $news->render() !!}
        </div>
    </div>
@stop