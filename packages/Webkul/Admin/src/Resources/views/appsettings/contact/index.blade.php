@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.appsettings.contact.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.appsettings.contact.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.contact.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.appsettings.contact.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('contact','Webkul\Admin\DataGrids\ContactDataGrid')
            {!! $contact->render() !!}
        </div>
    </div>
@stop