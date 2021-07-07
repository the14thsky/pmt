@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Org Role
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orgRole, ['route' => ['administration.orgRoles.update', $orgRole->id], 'method' => 'patch']) !!}

                        @include('administration.org_roles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection