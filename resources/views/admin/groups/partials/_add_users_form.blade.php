<div class="form-wrapper">
    {!! Form::open(['route' => ['admin::groups.active.sync.users', $group]]) !!}
        <div class="form-group">
            <div class="form-group">
                {!! Form::select('group_new_users[]', $outsiders, null,
                    ['id' => 'group_new_users',
                    'class' => 'form-control multiple-selection',
                    'data-description' => 'Search and choose users to add to this group...',
                    'multiple']) !!}
                {!! error_text($errors, 'group_new_users') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::submit('Find and add users', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div>
