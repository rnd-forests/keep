 <div id="search-keyword-modal" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">Your searching keyword cannot be blank. Try another keyword.</div>
        </div>
    </div>
</div>
{!! Form::open(['method' => 'GET', 'route' => ['user.tasks.search', $authUser], 'id' => 'search-form']) !!}
    <div class="form-group has-feedback">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            {!! Form::input('search', 'q', null, [
                'id' => 'keyword',
                'data-toggle' => 'popover',
                'data-placement' => 'bottom',
                'data-content' => 'Searching pattern cannot be blank.',
                'class' => 'form-control',
                'placeholder' => 'Search for tasks...'
            ]) !!}
        </div>
    </div>
{!! Form::close() !!}