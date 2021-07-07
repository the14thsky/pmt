
<div id="app">
    @if(isset($deliverableTemplate))
<example-component templatename="{{$deliverableTemplate->template_name}}" desc="{{$deliverableTemplate->description}}"  deliverable="{{json_encode($deliverableTemplate->deliverables)}}"></example-component>
    @else
    <example-component></example-component>
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('administration.deliverableTemplates.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('scripts')

<script src="{{ asset('js/app.js') }}"> </script>
@endpush
