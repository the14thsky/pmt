<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $customer->id }}</p>
</div>

<!-- Company Name Field -->
<div class="form-group">
    {!! Form::label('company_name', 'Company Name:') !!}
    <p>{{ $customer->company_name }}</p>
</div>

<!-- Comp Code Field -->
<div class="form-group">
    {!! Form::label('comp_code', 'Comp Code:') !!}
    <p>{{ $customer->comp_code }}</p>
</div>

<!-- Company Address Field -->
<div class="form-group">
    {!! Form::label('company_address', 'Company Address:') !!}
    <p>{{ $customer->company_address }}</p>
</div>

<!-- Country Id Field -->
<div class="form-group">
    {!! Form::label('country_id', 'Country Id:') !!}
    <p>{{ $customer->country_id }}</p>
</div>

<!-- Industry Id Field -->
<div class="form-group">
    {!! Form::label('industry_id', 'Industry Id:') !!}
    <p>{{ $customer->industry_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $customer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $customer->updated_at }}</p>
</div>

