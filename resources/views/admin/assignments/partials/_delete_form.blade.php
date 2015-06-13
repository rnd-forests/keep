{!! Form::open(array('method' => 'DELETE', 'route' => array('admin::assignments.published.delete', $assignment))) !!}
    <button type="submit" class="btn btn-danger btn-sm"
            data-toggle="tooltip" data-placement="bottom" title="Delete assignment">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}