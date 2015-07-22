<div class="row">
    <div class="col-md-12">
        <div id="search-keyword-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header text-center text-warning">Wrong searching pattern</div>
                    <div class="modal-body text-center">Your searching keyword cannot be blank. Try another keyword.</div>
                </div>
            </div>
        </div>
        {!! Form::open(['method' => 'GET', 'route' => ['member::tasks.search', $authUser], 'id' => 'search-form']) !!}
            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    {!! Form::input('search', 'q', null, [
                        'id' => 'keyword',
                        'data-toggle' => 'popover',
                        'data-placement' => 'bottom',
                        'data-content' => 'Searching pattern cannot be blank.',
                        'class' => 'form-control input-lg',
                        'placeholder' => 'Search for tasks...'
                    ]) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>