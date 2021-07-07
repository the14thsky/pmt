@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Public Holiday
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($holiday, ['route' => ['administration.holidays.update', $holiday->id], 'method' => 'patch']) !!}

                        @include('administration.holidays.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
