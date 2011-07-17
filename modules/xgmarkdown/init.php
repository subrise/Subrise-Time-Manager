<?php defined('SYSPATH') or die('No direct script access.');

/* catch all routes for xgmarkdown */
Route::set('xgmarkdown', 'xgmarkdown(.*)')
    ->defaults(array(
        'controller' => 'xgmarkdown',
        'action'     => 'index'
    ));
