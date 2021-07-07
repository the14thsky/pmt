@extends('layouts.app')

@section('content')

{!! Form::open(['route' => ['sales.projects.assignusers', $projId], 'method' => 'post']) !!}
    <section class="content-header">

        <h1 class="pull-left">Assign</h1>
        <h1 class="pull-right">
           <button class="btn btn-primary pull-right" type="submit" style="margin-top: -10px;margin-bottom: 5px" >Assign</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @section('css')
                @include('layouts.datatables_css')
            @endsection

            {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

            @push('scripts')
                @include('layouts.datatables_js')
                {!! $dataTable->scripts() !!}
            @endpush
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
    {!! Form::close() !!}
@endsection

