<?php
/*
 * Created on Wed Dec 17 2019 by DaRock
 *
 * Aweb Design
 * https://www.awebdesign.ro
 *
 */

namespace OpenCore\App\Http\Controllers\Catalog;

use OpenCore\App\Http\Controllers\Controller;

class ExampleController extends Controller
{
    function index() {
        return response("Catalog ExampleController CONTENT HERE");
    }

    function json() {
        return response()->json(['name' => 'OpenCore', 'by' => 'Aweb Design']);
    }
}
