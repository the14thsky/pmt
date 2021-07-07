<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $department->id }}</p>
</div>

<!-- Department Name Field -->
<div class="form-group">
    {!! Form::label('department_name', 'Department Name:') !!}
    <p>{{ $department->department_name }}</p>
</div>

<!-- Parent Field -->
<div class="form-group">
    {!! Form::label('parent', 'Parent:') !!}
    <p>{{ $department->parent }}</p>
</div>

