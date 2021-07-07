@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Deliverable Template
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deliverableTemplate, ['route' => ['administration.deliverableTemplates.update', $deliverableTemplate->id], 'method' => 'patch']) !!}

                        @include('administration.deliverable_templates.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection