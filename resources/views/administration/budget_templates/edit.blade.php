@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Budget Template
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($budgetTemplate, ['route' => ['administration.budgetTemplates.update', $budgetTemplate->id], 'method' => 'patch']) !!}

                        @include('administration.budget_templates.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection