{!! Form::open(['route' => ['admin::groups.flush', $group]]) !!}
    <button type="submit"
            class="btn btn-danger btn-xs"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Remove all users from group">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}