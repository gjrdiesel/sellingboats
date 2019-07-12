<?php

/**
 * Turn requests into URLs.
 *
 * i.e. 'year',['make'=>'Hewes'],['model'=>'Redfisher'] into ?year=2017&make=Hewes&model=Redfisher
 * (Year gets pulled from request())
 *
 * @param mixed ...$args
 *
 * @return string
 */
function build_url(...$args)
{
    return '?'.collect($args)->map(function ($arg) {
        if (is_array($arg)) {
            $request = key($arg).'='.$arg[key($arg)];
        } else {
            $request = $arg.'='.request($arg);
        }

        return $request;
    })->implode('&');
}
