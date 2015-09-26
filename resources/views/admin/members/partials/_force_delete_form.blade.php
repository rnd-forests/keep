{!! Form::open(['method' => 'DELETE', 'route' => ['admin::members.disabled.delete', $member]]) !!}
    <button type="submit"
            class="btn btn-danger btn-sm"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Permanently delete">
        <i class="fa fa-trash-o"></i>
    </button>
{!! Form::close() !!}