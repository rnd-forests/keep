@servers(['dev' => 'vagrant@127.0.0.1'])

{{-- testing task only --}}
@task('update', ['on' => 'dev'])
    composer update
@endtask