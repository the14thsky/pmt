<!-- Opportunity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opportunity_id', 'Opportunity Id:') !!}
    {!! Form::select('opportunity_id', ['' => ''], null, ['class' => 'form-control']) !!}
</div>

<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    {!! Form::select('customer_id', ['' => ''], null, ['class' => 'form-control']) !!}
</div>

<!-- Project Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_code', 'Project Code:') !!}
    {!! Form::text('project_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sales.projects.index') }}" class="btn btn-default">Cancel</a>
</div>
