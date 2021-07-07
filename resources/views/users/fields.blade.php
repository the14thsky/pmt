<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>




<!-- Department Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_id', 'Department:') !!}
    {!! Form::select('department_id', $departments, null, ['class' => 'form-control']) !!}
</div>

<!-- Org Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('org_role_id', 'Organisation Role:') !!}
    {!! Form::select('org_role_id', $orgRoles, null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>


<!-- Is 2Fa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roles', 'Roles:') !!}<br>
    {!! Form::checkbox('roles[]', 'superadmin', isset($roles) && in_array('superadmin',$roles) ? true : false) !!} Superadmin
    {!! Form::checkbox('roles[]', 'super_project_admin', isset($roles) && in_array('super_project_admin',$roles) ? true : false) !!} Super Project Admin
    {!! Form::checkbox('roles[]', 'project', isset($roles) && in_array('project',$roles) ? true : false) !!} Project
    {!! Form::checkbox('roles[]', 'super_sales_admin', isset($roles) && in_array('super_sales_admin',$roles) ? true : false) !!} Super Sales Admin
    {!! Form::checkbox('roles[]', 'sales', isset($roles) && in_array('sales',$roles) ? true : false) !!} Sales
    {!! Form::checkbox('roles[]', 'finance', isset($roles) && in_array('finance',$roles) ? true : false) !!} Finance
    {!! Form::checkbox('roles[]', 'staff', isset($roles) && in_array('staff',$roles) ? true : false) !!} Staff

</div>

<!-- Is 2Fa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_2fa', '2FA:') !!}
    {!! Form::checkbox('is_2fa', 1, isset($user->is_2fa) && $user->is_2fa==1 ? true : false) !!}
</div>

<div class="clearfix"></div>
<!-- Start Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Start Date:') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- End Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
</div>
