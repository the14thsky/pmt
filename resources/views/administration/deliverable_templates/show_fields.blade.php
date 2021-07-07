<!-- Template Name Field -->
<div class="form-group">
    {!! Form::label('template_name', 'Template Name:') !!}
    <p>{{ $deliverableTemplate->template_name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $deliverableTemplate->description }}</p>
</div>

<!-- Deliverables Field -->
<div class="form-group">
    {!! Form::label('deliverables', 'Deliverables:') !!}
    <p>{{ $deliverableTemplate->deliverables }}</p>
</div>

