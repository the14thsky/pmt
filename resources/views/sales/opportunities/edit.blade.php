@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Opportunity
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($opportunity, ['route' => ['sales.opportunities.update', $opportunity->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('sales.opportunities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection