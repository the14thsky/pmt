<div id="app">
    @if(isset($deliverableTemplate))
<deliverable-component title="{{$deliverableTemplate->template_name}}" deliverable="{{json_encode($deliverableTemplate->deliverables)}}" template="{{json_encode($templates ?? '')}}" csrf="{{csrf_token()}}"></deliverable-component>
    @else
    <deliverable-component budgetgroup="{{json_encode($budget_groups)}}" template="{{json_encode($templates ?? '')}}" csrf="{{csrf_token()}}"></deliverable-component>
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sales.deliverables.index') }}" class="btn btn-default">Cancel</a>
</div>

@push('scripts')
<script src="{{ asset('js/app.js') }}"> </script>
@endpush
