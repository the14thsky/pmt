<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $project->id }}</p>
</div>

<!-- Opportunity Id Field -->
<div class="form-group">
    {!! Form::label('opportunity_id', 'Opportunity Id:') !!}
    <p>{{ $project->opportunity_id }}</p>
</div>

<!-- Customer Id Field -->
<div class="form-group">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    <p>{{ $project->customer_id }}</p>
</div>

<!-- Project Code Field -->
<div class="form-group">
    {!! Form::label('project_code', 'Project Code:') !!}
    <p>{{ $project->project_code }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $project->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $project->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $project->updated_at }}</p>
</div>

