<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $engagement->id }}</p>
</div>

<!-- Customer Id Field -->
<div class="form-group">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    <p>{{ $engagement->customer_id }}</p>
</div>

<!-- Opportunity Id Field -->
<div class="form-group">
    {!! Form::label('opportunity_id', 'Opportunity Id:') !!}
    <p>{{ $engagement->opportunity_id }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $engagement->type }}</p>
</div>

<!-- Brief Description Field -->
<div class="form-group">
    {!! Form::label('brief_description', 'Brief Description:') !!}
    <p>{{ $engagement->brief_description }}</p>
</div>

<!-- Attachment Field -->
<div class="form-group">
    {!! Form::label('attachment', 'Attachment:') !!}
    <p>{{ $engagement->attachment }}</p>
</div>

<!-- Follow Up Field -->
<div class="form-group">
    {!! Form::label('follow_up', 'Follow Up:') !!}
    <p>{{ $engagement->follow_up }}</p>
</div>

<!-- Action Item Field -->
<div class="form-group">
    {!! Form::label('action_item', 'Action Item:') !!}
    <p>{{ $engagement->action_item }}</p>
</div>

<!-- Dateline Field -->
<div class="form-group">
    {!! Form::label('dateline', 'Dateline:') !!}
    <p>{{ $engagement->dateline }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $engagement->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $engagement->updated_at }}</p>
</div>

