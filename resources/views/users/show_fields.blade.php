<!-- Name Field -->
<div class="form-group">
    {!! Form::label('first_name', 'First Name:') !!}
    <p>{{ $user->first_name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Remember Token Field -->
<div class="form-group">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{{ $user->remember_token }}</p>
</div>

<!-- Last Name Field -->
<div class="form-group">
    {!! Form::label('last_name', 'Last Name:') !!}
    <p>{{ $user->last_name }}</p>
</div>

<!-- Org Role Id Field -->
<div class="form-group">
    {!! Form::label('org_role_id', 'Org Role Id:') !!}
    <p>{{ $user->org_role_id }}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Department Id:') !!}
    <p>{{ $user->department_id }}</p>
</div>

<!-- Is 2Fa Field -->
<div class="form-group">
    {!! Form::label('is_2fa', 'Is 2Fa:') !!}
    <p>{{ $user->is_2fa }}</p>
</div>

<!-- Start Date Field -->
<div class="form-group">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $user->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $user->end_date }}</p>
</div>
