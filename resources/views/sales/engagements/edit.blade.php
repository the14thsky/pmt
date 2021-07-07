@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Engagement
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($engagement, ['route' => ['sales.engagements.update', $engagement->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('sales.engagements.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection