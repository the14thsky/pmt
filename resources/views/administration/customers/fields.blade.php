<!-- Company Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_name', 'Company Name:') !!}
    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Comp Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comp_code', 'Comp Code:') !!}
    {!! Form::text('comp_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Company Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('company_address', 'Company Address:') !!}
    {!! Form::textarea('company_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id',$countries, null, ['class' => 'form-control']) !!}
</div>


<!-- industry Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('industry_id', 'Industry:') !!}
    {!! Form::select('industry_id',$industries, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sales.customers.index') }}" class="btn btn-default">Cancel</a>
</div>
