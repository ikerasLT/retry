<?php

if (! function_exists('retry_callback')) {
    function retry_callback(callable $callback, callable $action, $repeat = 1)
    {
        $br = 1;

        try {
            return $callback();
        } catch (\Exception $e) {
            if ($repeat) {
                $action();
                $repeat--;
                return retry($callback, $action, $repeat);
            } else {
                throw $e;
            }
        }
    }
}