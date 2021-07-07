@if(!isset($opportunities))
<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Company Name:') !!}
    {!! Form::select('customer_id',$customers, null, ['class' => 'form-control']) !!}
</div>
@endif

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['phone' => 'phone', 'email' => 'email', 'meeting' => 'meeting', 'presentation' => 'presentation', 'submit quote' => 'submit quote'], null, ['class' => 'form-control']) !!}
</div>

<!-- Brief Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('brief_description', 'Brief Description:') !!}
    {!! Form::textarea('brief_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Attachment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attachment', 'Attachment:') !!}
    {!! Form::file('attachment') !!}
</div>
<div class="clearfix"></div>

<!-- Follow Up Field -->
<div class="form-group col-sm-6">
    {!! Form::label('follow_up', 'Follow Up:') !!}
    {!! Form::select('follow_up', ['Yes' => 'Yes', 'No' => 'No'], null, ['class' => 'form-control']) !!}
</div>

<!-- Action Item Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action_item', 'Action Item:') !!}
    {!! Form::text('action_item', null, ['class' => 'form-control']) !!}
</div>

<!-- Dateline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dateline', 'Dateline:') !!}
    {!! Form::text('dateline', null, ['class' => 'form-control','id'=>'dateline']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#dateline').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sales.opportunities.index') }}" class="btn btn-default">Cancel</a>
</div>
