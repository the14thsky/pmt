{!! Form::open(['route' => ['sales.opportunities.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @if($status!=='Published')
    <a href="{{ route('sales.engagements.customCreate', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-plus"></i>
    </a>

    <a href="{{ route('sales.engagements.index', ['id'=>$id]) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>

    <a href="{{ route('sales.opportunities.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
@else
<a href="{{ route('sales.engagements.index', ['id'=>$id]) }}" class='btn btn-default btn-xs'>
    <i class="glyphicon glyphicon-eye-open"></i>
</a>

@endif
</div>
{!! Form::close() !!}
