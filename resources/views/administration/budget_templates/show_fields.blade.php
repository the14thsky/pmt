<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $budgetTemplate->id }}</p>
</div>

<!-- Template Name Field -->
<div class="form-group">
    {!! Form::label('template_name', 'Template Name:') !!}
    <p>{{ $budgetTemplate->template_name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $budgetTemplate->description }}</p>
</div>

<!-- Budgets Field -->
<div class="form-group">
    {!! Form::label('budgets', 'Budgets:') !!}
    <p>{{ $budgetTemplate->budgets }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $budgetTemplate->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $budgetTemplate->updated_at }}</p>
</div>

