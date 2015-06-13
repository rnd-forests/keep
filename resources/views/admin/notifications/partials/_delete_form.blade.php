{!! Form::open(array('method' => 'DELETE', 'route' => array('admin::notifications.delete', $notification))) !!}
    <button type="submit" class="btn btn-danger btn-sm"
            data-toggle="tooltip" data-placement="bottom" title="Delete notification">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}