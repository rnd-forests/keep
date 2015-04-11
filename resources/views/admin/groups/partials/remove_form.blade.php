{!! Form::open(array('route' => array('admin.groups.remove.user', $group->slug, $user->id))) !!}
    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Remove from group">
        Remove
    </button>
{!! Form::close() !!}