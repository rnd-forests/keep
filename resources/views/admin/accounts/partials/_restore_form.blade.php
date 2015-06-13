{!! Form::open(array('method' => 'PUT', 'route' => array('admin::members.disabled.restore', $user))) !!}
    <button type="submit" class="btn btn-info btn-circle btn-sm"
            data-toggle="tooltip" data-placement="bottom" title="Restore account">
        <i class="fa fa-arrow-left"></i>
    </button>
{!! Form::close() !!}