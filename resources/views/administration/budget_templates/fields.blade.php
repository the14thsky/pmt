<!-- Template Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('template_name', 'Template Name:') !!}
    {!! Form::text('template_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-11 seperator">
    <h4 style="display: inline-block">Project Budget</h4>
    <button class="pull-right btn btn-success" style="display: inline-block" type="button" id="addmorebudget">Add More</button>
</div>

    <div class="col-sm-4 text-center text-bold">Budget Group</div>
    <div class="col-sm-4 text-center text-bold">Amount (SGD)</div>
    <div class="col-sm-4 text-center text-bold">Man-Day</div>

<div class="templatebudget" style="display: none">
 <div class="col-lg-12">
  <!-- Contact Person Name Field -->
<div class="form-group col-sm-4">

    {!! Form::text('budgets[budget_group][]', '', ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Email Field -->
<div class="form-group col-sm-4">

    {!! Form::text('budgets[amount][]', '', ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Phone Field -->
<div class="form-group col-sm-4">

    {!! Form::text('budgets[man_day][]', '', ['class' => 'form-control']) !!}
</div>
<a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

</div>
</div>
<div class="budget">
    @if(isset($budgetTemplate->budgets['budget_group']))
    @foreach($budgetTemplate->budgets['budget_group'] as $index=>$work)
        @if($index>0)
        <div class="col-lg-12">
        <div class="form-group col-sm-4 col-lg-4">

            {!! Form::text('budgets[budget_group]['.$index.']', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4 col-lg-4">

            {!! Form::text('budgets[amount]['.$index.']', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4 col-lg-4">

            {!! Form::text('budgets[man_day]['.$index.']', null, ['class' => 'form-control']) !!}
        </div>
        <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>
        </div>


        @endif
        @endforeach

        @else
        <div class="col-lg-12">
        <div class="form-group col-sm-4 col-lg-4">

            {!! Form::text('budgets[budget_group][]', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4 col-lg-4">

            {!! Form::text('budgets[amount][]', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4 col-lg-4">

            {!! Form::text('budgets[man_day][]', null, ['class' => 'form-control']) !!}
        </div>

        <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

    </div>
    @endif

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('administration.budgetTemplates.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#addmorebudget").click(function(){
        var temp =  $('.templatebudget').clone();
        $('.budget').append(temp[0].innerHTML);

    });

    $(".budget").on('click',"a#delete",function(e){
        //console.log($(this).closest('.col-lg-12'));
        $(this).parent().remove();
    })


    });


</script>
@endpush
