{!! Form::open(array('method' => 'PUT', 'route' => array('admin.groups.restore', $group->slug))) !!}
    <button type="submit" class="btn btn-info btn-circle btn-sm"
        data-toggle="tooltip" data-placement="bottom" title="Restore group">
        <i class="fa fa-arrow-left"></i>
    </button>
{!! Form::close() !!}