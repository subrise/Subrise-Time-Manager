<?php defined('SYSPATH') or die('No direct script access.');

class Controller_XgMarkdown extends Controller
{
    public function action_index()
    {
        $string = '
# Lorem ipsum #
## Lorem ipsum ##
### Lorem ipsum ###

*dolor sit amet*, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren.

1. no
1. sea
1. takimata
1. sanctus
1. est

* Lorem
* ipsum
* dolor sit amet.

> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum **dolor sit amet**.

<http://google.de/>

[google.de](http://www.google.de/)
';

        echo '<h2>Base string</h2>';
        echo '<div style="background:#efefef;padding:10px;"><pre>'.htmlspecialchars($string).'</pre></div>';

        echo '<h2>Parsed string</h2>';
        echo '<div style="background:#efefef;padding:10px;">'.XgMarkdown_Parser::parse($string).'</div>';

        echo '<h2>Stripped string</h2>';
        echo '<div style="background:#efefef;padding:10px;">'.XgMarkdown_Parser::strip($string).'</div>';
    }
}
