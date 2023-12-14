<?php

use EightyNine\Reports\ReportsManager;

if (!function_exists("reports")) {
    function reports(): ReportsManager
    {
        return ReportsManager::getInstance();
    }
}
