<?php

Form::macro('delete', function ($url, $label, $options = array(), $parameters = array())
{
    $parameters['url'] = $url;
    $parameters['method'] = 'DELETE';

    return Form::open($parameters)
    . Form::submit($label, $options)
    . Form::close();
});