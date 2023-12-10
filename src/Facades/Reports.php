<?php

namespace EightyNine\Reports\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EightyNine\Reports\Reports
 */
class Reports extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EightyNine\Reports\Reports::class;
    }
}
