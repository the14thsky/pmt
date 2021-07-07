@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Time Charging
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div id="app">
                        <timecharge-component :deliverable_list="{{json_encode($deliverable_list)}}" projid="{{$projId}}" ></timecharge-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('js/app.js') }}"> </script>
@endpush
