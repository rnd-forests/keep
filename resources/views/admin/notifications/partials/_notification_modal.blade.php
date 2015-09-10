<div class="modal fade" id="notification-selection-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title text-center">
                    Who do you want to notify something new?
                </h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <a href="{{ route('admin::notifications.member.create') }}">
                        <button type="button" class="btn btn-primary">Members</button>
                    </a>
                    <a href="{{ route('admin::notifications.group.create') }}">
                        <button type="button" class="btn btn-primary">Groups</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>