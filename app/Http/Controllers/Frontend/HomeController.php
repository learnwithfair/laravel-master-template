<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller {
    public function index() {

        // return view( 'frontend.index' );
        return view( 'welcome' );
    }

    public function test() {

        return view( 'frontend.ajax.ajax_test' );
    }
}