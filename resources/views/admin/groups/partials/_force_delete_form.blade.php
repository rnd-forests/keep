{!! Form::open(array('method' => 'DELETE', 'route' => array('admin::groups.trashed.force.delete', $group))) !!}
    <button type="submit" class="btn btn-danger btn-circle btn-sm"
            data-toggle="tooltip" data-placement="bottom" title="Permanently delete">
        <i class="fa fa-trash-o"></i>
    </button>
{!! Form::close() !!}