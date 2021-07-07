<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $opportunity->id }}</p>
</div>

<!-- Customer Id Field -->
<div class="form-group">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    <p>{{ $opportunity->customer_id }}</p>
</div>

<!-- Contact Person Name Field -->
<div class="form-group">
    {!! Form::label('contact_person_name', 'Contact Person Name:') !!}
    <p>{{ $opportunity->contact_person_name }}</p>
</div>

<!-- Contact Person Email Field -->
<div class="form-group">
    {!! Form::label('contact_person_email', 'Contact Person Email:') !!}
    <p>{{ $opportunity->contact_person_email }}</p>
</div>

<!-- Contact Person Phone Field -->
<div class="form-group">
    {!! Form::label('contact_person_phone', 'Contact Person Phone:') !!}
    <p>{{ $opportunity->contact_person_phone }}</p>
</div>

<!-- Opportunity Description Field -->
<div class="form-group">
    {!! Form::label('opportunity_description', 'Opportunity Description:') !!}
    <p>{{ $opportunity->opportunity_description }}</p>
</div>

<!-- Detailed Requirement Field -->
<div class="form-group">
    {!! Form::label('detailed_requirement', 'Detailed Requirement:') !!}
    <p>{{ $opportunity->detailed_requirement }}</p>
</div>

<!-- Estimated Budget Field -->
<div class="form-group">
    {!! Form::label('estimated_budget', 'Estimated Budget:') !!}
    <p>{{ $opportunity->estimated_budget }}</p>
</div>

<!-- Chances Field -->
<div class="form-group">
    {!! Form::label('chances', 'Chances:') !!}
    <p>{{ $opportunity->chances }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $opportunity->status }}</p>
</div>

<!-- Remarks Field -->
<div class="form-group">
    {!! Form::label('remarks', 'Remarks:') !!}
    <p>{{ $opportunity->remarks }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $opportunity->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $opportunity->updated_at }}</p>
</div>

