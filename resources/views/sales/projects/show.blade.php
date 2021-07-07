@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Project
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div id="app">
                    <scheduler-component :deliverable="{{json_encode($project->deliverable)}}"></scheduler-component>
                    </div>
                    <a href="{{ route('sales.projects.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('js/app.js') }}"> </script>
@endpush
