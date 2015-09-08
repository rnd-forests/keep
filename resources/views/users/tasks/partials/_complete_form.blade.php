<div class="modal" id="task-complete-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title"></p>
            </div>
        </div>
    </div>
</div>

{!! Form::model($task, ['method' => 'PATCH', 'route' => ['member::tasks.complete', $user, $task], 'id' => 'task-complete-form']) !!}
    <div class="switch">
        {!! Form::checkbox('completed', 1, null, ['id' => 'completed', 'class' => 'cmn-toggle cmn-toggle-round-flat']) !!}
        <label for="completed"></label>
    </div>
{!! Form::close() !!}
