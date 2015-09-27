{!! Form::open(['method' => 'PUT', 'route' => ['admin::groups.trashed.restore', $group]]) !!}
    <button type="submit"
            class="btn btn-info btn-xs"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Restore group">
        <i class="fa fa-arrow-left"></i>
    </button>
{!! Form::close() !!}