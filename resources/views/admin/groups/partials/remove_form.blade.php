{!! Form::open(array('route' => array('admin.groups.remove.user', $group, $user->id))) !!}
    <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Remove from group">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}