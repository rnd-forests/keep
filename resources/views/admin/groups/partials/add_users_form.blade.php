{!! Form::open(['route' => ['admin.groups.sync.users', $group->slug]]) !!}
    <div class="form-group">
        <div class="form-group">
            {!! Form::select('group_new_users[]', $outsiders, null, ['id' => 'group_new_users', 'class' => 'form-control', 'multiple']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit('Add', ['class' => 'btn btn-lg btn-primary']) !!}
    </div>
{!! Form::close() !!}