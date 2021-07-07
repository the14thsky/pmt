<!-- Customer_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Company Name:') !!}
    {!! Form::select('customer_id',$companies, null, ['class' => 'form-control']) !!}
</div>

<!-- title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Opportunity Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<!-- Work Performed Last 24Hrs Field -->
<div class="form-group col-sm-11 seperator">
    <h4 style="display: inline-block">Personnel(s)</h4>
    <button class="pull-right btn btn-success" style="display: inline-block" type="button" id="addmore">Add More</button>
</div>

    <div class="col-sm-3 text-center text-bold">Name</div>
    <div class="col-sm-3 text-center text-bold">Email</div>
    <div class="col-sm-3 text-center text-bold">Phone</div>
    <div class="col-sm-3 text-center text-bold">Remarks</div>

<div class="template" style="display: none">
    <div class="col-lg-12">
  <!-- Contact Person Name Field -->
<div class="form-group col-sm-3">

    {!! Form::text('contact_person_name[]', '', ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Email Field -->
<div class="form-group col-sm-3">

    {!! Form::email('contact_person_email[]', '', ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Phone Field -->
<div class="form-group col-sm-3">

    {!! Form::text('contact_person_phone[]', '', ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Remarks Field -->
<div class="form-group col-sm-3">

    {!! Form::text('contact_person_remarks[]', '', ['class' => 'form-control']) !!}
</div>
<a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

</div>
</div>
<div class="work">
    @if(isset($opportunity->contact_person_name))
    @foreach($opportunity->contact_person_name as $index=>$work)
        @if($index>0)

        <div class="col-lg-12">
        <div class="form-group col-sm-3 col-lg-3">

            {!! Form::text('contact_person_name['.$index.']', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3 col-lg-3">

            {!! Form::text('contact_person_email['.$index.']', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3 col-lg-3">

            {!! Form::text('contact_person_phone['.$index.']', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3 col-lg-3">

            {!! Form::text('contact_person_remarks['.$index.']', null, ['class' => 'form-control']) !!}
        </div>
        <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

        </div>
        @endif
        @endforeach
    @else
    <!-- Contact Person Name Field -->
    <div class="col-lg-12">
<div class="form-group col-sm-3">

    {!! Form::text('contact_person_name[]', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Email Field -->
<div class="form-group col-sm-3">

    {!! Form::email('contact_person_email[]', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Phone Field -->
<div class="form-group col-sm-3">

    {!! Form::text('contact_person_phone[]', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Remarks Field -->
<div class="form-group col-sm-3">

    {!! Form::text('contact_person_remarks[]', null, ['class' => 'form-control']) !!}
</div>
<a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

    </div>
    @endif

</div>


<!-- Opportunity Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('opportunity_description', 'Opportunity Description:') !!}
    {!! Form::textarea('opportunity_description', null, ['class' => 'form-control']) !!}
</div>

@if(isset($opportunity) && $opportunity->detailed_requirement)
<div class="form-group col-sm-6">
{!! Form::label('detailed_requirement', 'Detailed Requirement:') !!}

<a href="{{ url($opportunity->detailed_requirement)}}" target="blank">View</a>
</div>
@endif


<!-- Detailed Requirement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('detailed_requirement', 'Detailed Requirement:') !!}
    {!! Form::file('detailed_requirement') !!}
</div>
<div class="clearfix"></div>

<!-- Estimated Budget Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estimated_budget', 'Estimated Budget:') !!}
    {!! Form::text('estimated_budget', null, ['class' => 'form-control']) !!}
</div>

<!-- Chances Field -->
<div class="form-group col-sm-6">
    {!! Form::label('chances', 'Chances:') !!}
    {!! Form::select('chances', ['select' => 'select', 'Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High'], null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['select' => 'select', 'Active' => 'Active', 'Closed' => 'Closed', 'Awarded' => 'Awarded','Published' => 'Published'], null, ['class' => 'form-control']) !!}
</div>

<div class="loose hidden">
<!-- reason_loosing_bid Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reason_loosing_bid', 'Reason for losing the bid:') !!}
    {!! Form::textarea('reason_loosing_bid', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="award hidden">

    <!-- total_award_value Field -->
    <div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('total_award_value', 'Total award value:') !!}
    {!! Form::text('total_award_value', null, ['class' => 'form-control']) !!}
    </div>

     <!-- po_number Field -->
     <div class="form-group col-sm-6 col-lg-6">
        {!! Form::label('po_number', 'PO Number:') !!}
        {!! Form::text('po_number', null, ['class' => 'form-control']) !!}
        </div>

     <!-- po_date Field -->
     <div class="form-group col-sm-6 col-lg-6">
        {!! Form::label('po_date', 'PO Date:') !!}
        {!! Form::text('po_date', null, ['class' => 'form-control', 'id'=>'po_date']) !!}
        </div>

        @push('scripts')
        <script type="text/javascript">
        $('#po_date').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: true,
            sideBySide: true
        })
        </script>
        @endpush

    @if(isset($opportunity) && $opportunity->po_attachment)
    <div class="form-group col-sm-6">
    {!! Form::label('po_attachment', 'PO Attachment:') !!}

    <a href="{{ url($opportunity->po_attachment)}}" target="blank">View</a>
    </div>
    @endif

     <!-- po_attachment Field -->
     <div class="form-group col-sm-6 col-lg-6">
        {!! Form::label('po_attachment', 'PO Attachment:') !!}
        {!! Form::file('po_attachment', null, ['class' => 'form-control']) !!}
        </div>

<!-- invoicing_instruction Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('invoicing_instruction', 'Invoicing Instructions:') !!}
    {!! Form::textarea('invoicing_instruction', null, ['class' => 'form-control']) !!}
    </div>


    <div class="form-group col-sm-11 seperator">
        <h4 style="display: inline-block">Payment Milestones</h4>
        <button class="pull-right btn btn-success" style="display: inline-block" type="button" id="addmoremilestone">Add More</button>
    </div>

        <div class="col-sm-4 text-center text-bold">Milestone</div>
        <div class="col-sm-4 text-center text-bold">% of total</div>
        <div class="col-sm-4 text-center text-bold">Amount (SGD)</div>

    <div class="templatemilestone" style="display: none">
        <div class="col-lg-12">
      <!-- Contact Person Name Field -->
    <div class="form-group col-sm-4">

        {!! Form::text('payment_milestones[milestone][]', '', ['class' => 'form-control']) !!}
    </div>

    <!-- Contact Person Email Field -->
    <div class="form-group col-sm-4">

        {!! Form::text('payment_milestones[per_of_total][]', '', ['class' => 'form-control']) !!}
    </div>

    <!-- Contact Person Phone Field -->
    <div class="form-group col-sm-4">

        {!! Form::text('payment_milestones[amount][]', '', ['class' => 'form-control']) !!}
    </div>
    <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

        </div>
    </div>
    <div class="milestone">
        @if(isset($opportunity->payment_milestones['milestone']))
        @foreach($opportunity->payment_milestones['milestone'] as $index=>$work)
            @if($index>0)
            <div class="col-lg-12">
            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('payment_milestones[milestone]['.$index.']', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('payment_milestones[per_of_total]['.$index.']', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('payment_milestones[amount]['.$index.']', null, ['class' => 'form-control']) !!}
            </div>
            <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

            </div>



            @endif
            @endforeach


            @else
            <div class="col-lg-12">
            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('payment_milestones[milestone][]', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('payment_milestones[per_of_total][]', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('payment_milestones[amount][]', null, ['class' => 'form-control']) !!}
            </div>
            <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

            </div>
        @endif

    </div>


    <div class="form-group col-sm-11 seperator">
        <h4 style="display: inline-block">Project Budget</h4>
        <button class="pull-right btn btn-success" style="display: inline-block" type="button" id="addmorebudget">Add More</button>

        &nbsp;&nbsp;{!! Form::label('budgets', 'Select Template:') !!}
        {!! Form::select('budgets', $budgets, null, []) !!}

    </div>

        <div class="col-sm-4 text-center text-bold">Budget Group</div>
        <div class="col-sm-4 text-center text-bold">Amount (SGD)</div>
        <div class="col-sm-4 text-center text-bold">Man-Day</div>

    <div class="templatebudget" style="display: none">
        <div class="col-lg-12">
      <!-- Contact Person Name Field -->
    <div class="form-group col-sm-4">

        {!! Form::text('project_budget[budget_group][]', '', ['class' => 'form-control']) !!}
    </div>

    <!-- Contact Person Email Field -->
    <div class="form-group col-sm-4">

        {!! Form::text('project_budget[amount][]', '', ['class' => 'form-control']) !!}
    </div>

    <!-- Contact Person Phone Field -->
    <div class="form-group col-sm-4">

        {!! Form::text('project_budget[man_day][]', '', ['class' => 'form-control']) !!}
    </div>
    <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

        </div>
    </div>
    <div class="budget">
        @if(isset($opportunity->project_budget['budget_group']))
        @foreach($opportunity->project_budget['budget_group'] as $index=>$work)
            @if($index>0)
            <div class="col-lg-12">
            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('project_budget[budget_group]['.$index.']', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('project_budget[amount]['.$index.']', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('project_budget[man_day]['.$index.']', null, ['class' => 'form-control']) !!}
            </div>
            <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

            </div>


            @endif
            @endforeach

            @else
            <div class="col-lg-12">
            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('project_budget[budget_group][]', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('project_budget[amount][]', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-4 col-lg-4">

                {!! Form::text('project_budget[man_day][]', null, ['class' => 'form-control']) !!}
            </div>
            <a role="button" class="btn btn-danger" style="position: absolute; right:1px" id="delete"><i class="fa fa-minus"></i></a>

            </div>
        @endif

    </div>

</div>
<!-- Remarks Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('remarks', 'Remarks:') !!}
    {!! Form::textarea('remarks', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'name'=>'save']) !!}
    {!! Form::submit('Publish', ['class' => 'btn btn-warning hidden', 'id'=>'publish', 'name'=>'publish']) !!}
    <a href="{{ route('sales.opportunities.index') }}" class="btn btn-default">Cancel</a>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        var value = $('#status').children("option:selected").val();
        addFields(value);

        $("#addmore").click(function(){
        var temp =  $('.template').clone();
        $('.work').append(temp[0].innerHTML);

    });

    $(".work").on('click','a#delete',function(e){

        $(this).parent().remove();
    });

    $("#addmoremilestone").click(function(){
    var temp =  $('.templatemilestone').clone();
    $('.milestone').append(temp[0].innerHTML);

    });

    $(".milestone").on('click','a#delete',function(e){

        $(this).parent().remove();
    });


    $("#addmorebudget").click(function(){
    var temp =  $('.templatebudget').clone();
    $('.budget').append(temp[0].innerHTML);

    });

    $(".budget").on('click','a#delete',function(e){

        $(this).parent().remove();
    });

    });

    $("#status").on('change', function(e){
       var value = $(this).children("option:selected").val();
       addFields(value);
    })

    $("#budgets").on('change', function(e){
       var value = $(this).children("option:selected").val();
       if(value){
            var url = window.location.href.split('?')[0]+"?budget="+value;
            document.location = url;
       }
    })

    function addFields(value){
        if(value=='Closed'){
            $('.loose').removeClass('hidden');
            $('.award').addClass('hidden');
            $('#publish').addClass('hidden');
        }
        else if(value=='Awarded' || value=='Published'){
            $('.loose').addClass('hidden');
            $('.award').removeClass('hidden');
            $('#publish').removeClass('hidden');
        }
    }


    </script>
@endpush

