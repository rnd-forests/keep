<div class="modal fade" id="assignment-selection-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title text-center">
                    Who do you want to assign new assignment to?
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <a href="{{ route('member.assignments') }}">
                        <button type="button" class="btn btn-primary">Members</button>
                    </a>
                    <a href="{{ route('group.assignments') }}">
                        <button type="button" class="btn btn-primary">Groups</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>