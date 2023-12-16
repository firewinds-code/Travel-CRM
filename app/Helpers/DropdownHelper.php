<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ProcessOption;

class DropdownHelper
{
    public static function getPlaces()
    {
        // Retrieve options from the database, including both default and custom options
        $optionsFromDatabase = DB::table('sites')->get();
        
        // Process the retrieved options into an associative array
        $placeOptions = [];
        foreach ($optionsFromDatabase as $option) {
            $placeOptions[$option->id] = $option->places;
        }
        return $placeOptions;
    }

    static function getProcess()
    {
        // Retrieve options from the database, including both default and custom options
        $optionsFromDatabase = DB::table('process_options')->get();

        // Process the retrieved options into an associative array
        $processOptions = [];
        foreach ($optionsFromDatabase as $option) {
            $processOptions[$option->id] = $option->process;
        }
        return $processOptions;
    }
}