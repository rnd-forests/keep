{!! Form::open(array('route' => array('admin.groups.remove.user', $group->slug, $user->id))) !!}
    <button type="submit" class="btn btn-circle btn-warning" data-toggle="tooltip" data-placement="bottom" title="Remove from group">
        <i class="fa fa-minus"></i>
    </button>
{!! Form::close() !!}