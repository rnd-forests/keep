{!! Form::open(array('route' => array('admin.groups.flush', $group->slug))) !!}
    <button type="submit" class="btn btn-danger">
        Remove all users
    </button>
{!! Form::close() !!}