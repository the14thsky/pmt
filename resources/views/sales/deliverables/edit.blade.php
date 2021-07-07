@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Deliverable
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deliverable, ['route' => ['sales.deliverables.update', $deliverable->id], 'method' => 'patch']) !!}

                        @include('sales.deliverables.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection