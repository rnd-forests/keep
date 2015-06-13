{!! Form::open(array('route' => array('admin::groups.active.remove.users', $group, $user->id))) !!}
    <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Remove from group">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}