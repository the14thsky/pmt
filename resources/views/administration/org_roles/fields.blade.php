<!-- Role Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_name', 'Role Name:') !!}
    {!! Form::text('role_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('administration.orgRoles.index') }}" class="btn btn-default">Cancel</a>
</div>
