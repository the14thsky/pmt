@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Milestones
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div id="app">
                        <milestone-component :milestone="{{json_encode($milestones)}}" company="{{$company_name}}" comp_code="{{$comp_code}}" role="{{$role}}"></milestone-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('js/app.js') }}"> </script>
@endpush
