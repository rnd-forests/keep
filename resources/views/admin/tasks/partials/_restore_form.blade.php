{!! Form::open(['method' => 'PUT', 'route' => ['admin.tasks.trashed.restore', $task]]) !!}
    <button type="submit"
            class="btn btn-info btn-xs"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Restore this task">
        <i class="fa fa-arrow-left"></i>
    </button>
{!! Form::close() !!}