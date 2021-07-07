{!! Form::open(['route' => ['sales.projects.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('sales.deliverables.customCreate', App\Models\Sales\Project::find($id)->opportunity->id) }}" data-toggle="tooltip" title="Deliverables" class='btn btn-default btn-xs' alt>
        <i class="fa fa-plus"></i>
    </a>

    <a href="{{ route('sales.projects.show', $id) }}"  data-toggle="tooltip" title="Schedule" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('sales.projects.assign', $id) }}"  data-toggle="tooltip" title="Assign"  class='btn btn-default btn-xs'>
        <i class="fa fa-tag"></i>
    </a>

    <a href="{{ route('sales.projects.milestone', $id) }}"  data-toggle="tooltip" title="Milestone"  class='btn btn-default btn-xs'>
        <i class="fa fa-dollar"></i>
    </a>

    <a href="{{ route('sales.projects.timecharge', $id) }}"  data-toggle="tooltip" title="TimeCharge"  class='btn btn-default btn-xs'>
        <i class="fa fa-hourglass-2"></i>
    </a>
    {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!} --}}
</div>
{!! Form::close() !!}
