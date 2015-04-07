{!! Form::open(array('method' => 'DELETE', 'route' => array('admin.active.account.disable', $account->slug))) !!}
    <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#admin-cancel-account-modal">
        <i class="fa fa-times"></i>
    </button>
{!! Form::close() !!}

<div class="modal fade" id="admin-cancel-account-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Once this account is disabled, the system will immediately disabled all tasks, and
                    all other things related to this account.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirm">Disable account</button>
            </div>
        </div>
    </div>
</div>