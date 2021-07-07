<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $orgRole->id }}</p>
</div>

<!-- Role Name Field -->
<div class="form-group">
    {!! Form::label('role_name', 'Role Name:') !!}
    <p>{{ $orgRole->role_name }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $orgRole->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $orgRole->updated_at }}</p>
</div>

