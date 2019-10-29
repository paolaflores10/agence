<?php

Validator::extend('mayor_cero', function($attribute, $value, $parameters)
{
    return preg_match('/^[1-9]+/', $value);
    
});