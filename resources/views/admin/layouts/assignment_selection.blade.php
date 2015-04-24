<div class="modal fade" id="assignment-selection-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    Who do you want to assign new assignment to?
                </h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <a href="{{ route('member.assignments') }}">
                        <button type="button" class="btn btn-primary">MEMBERS</button>
                    </a>
                    <a href="{{ route('group.assignments') }}">
                        <button type="button" class="btn btn-primary">GROUPS</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>