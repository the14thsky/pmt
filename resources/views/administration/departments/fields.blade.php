<!-- Department Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_name', 'Department Name:') !!}
    {!! Form::text('department_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent', 'Parent Department:') !!}
    {!! Form::select('parent',$parents, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('administration.departments.index') }}" class="btn btn-default">Cancel</a>
</div>
