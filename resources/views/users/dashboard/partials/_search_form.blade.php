{!! Form::open(['method' => 'GET', 'route' => ['member::tasks.search', $authUser], 'id' => 'search-form']) !!}
    <div class="form-group has-feedback">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-search"></span></span>
            {!! Form::input('search', 'q', null, [
                'id' => 'keyword',
                'data-toggle' => 'popover',
                'data-placement' => 'bottom',
                'data-content' => 'Searching pattern cannot be blank.',
                'class' => 'form-control input-lg',
                'placeholder' => 'Search tasks...'
            ]) !!}
        </div>
    </div>
{!! Form::close() !!}