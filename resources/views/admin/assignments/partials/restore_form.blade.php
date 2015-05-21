{!! Form::open(array('method' => 'PUT', 'route' => array('admin.assignments.restore', $assignment))) !!}
    <button type="submit" class="btn btn-info btn-circle btn-sm"
            data-toggle="tooltip" data-placement="bottom" title="Restore assignment">
        <i class="fa fa-arrow-left"></i>
    </button>
{!! Form::close() !!}