{!! Form::open(['method' => 'DELETE', 'route' => ['admin::notifications.delete', $notification]]) !!}
    <button type="submit"
            class="btn btn-danger btn-xs"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Delete notification">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}