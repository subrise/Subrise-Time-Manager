<?php defined('SYSPATH') or die('No direct script access.');
/**
 *  this XgMarkdown_Parser class parses/strips Markdown strings
 *  wrapping the Markdown_Parser Class by Michel Fortin.
 *
 *  @autor      f.fiebig <webpiraten>
 *  @version    1.0
 *  @since      06/2011
 *
 *  PHP Markdown & Extra
 *  Copyright (c) 2004-2009 Michel Fortin
 *  <http://michelf.com/projects/php-markdown/>
 *
 *  Original Markdown
 *  Copyright (c) 2004-2006 John Gruber
 *  <http://daringfireball.net/projects/markdown/>
 *
 *  usage like this:
 *
 *  // configure the parser filters and behavior in /config/xgmarkdown.php
 *  return array(
 *      'add_nl2br'     => true,
 *      'add_nofollow'  => true,
 *      'add_blank'     => true
 *  );
 *
 *  $string = '#Lorem ipsum# dolor sit amet, *consetetur* sadipscing elitr, sed diam **nonumy** [google.de](http://www.google.de/)';
 *
 *  // parse string
 *  echo XgMarkdown_Parser::parse($string, true, false);
 *
 *  // strip string;
 *  echo XgMarkdown_Parser::strip($string);
 */
require_once 'markdown.php';

class XgMarkdown_Parser
{
    public static function parse($string, $nofollow = false, $blank = false)
    {
        $parser = new Markdown_Parser;
        $string = $parser->transform($string);

        if(Kohana::config('xgmarkdown.add_nl2br'))
        {
            $string = self::nlToBr($string);
        }

        if($nofollow || Kohana::config('xgmarkdown.add_nofollow'))
        {
            $string = self::setNoFollow($string);
        }

        if($blank || Kohana::config('xgmarkdown.add_blank'))
        {
            $string = self::setBlank($string);
        }

        return $string;
    }

    public static function strip($string)
    {
        $string = self::parse($string, false, false);
        return strip_tags($string);
    }

    private static function setNoFollow($string)
    {
        return str_replace('href=', 'rel="nofollow" href=', $string);
    }

    private static function setBlank($string)
    {
        return str_replace('href=', 'target="_blank" href=', $string);
    }

    private static function nlToBr($string)
    {
         // normally PHP_EOL is the splitter, but in some cases not
        $lines  = explode("\n\r", $string);
        $retval = '';
        foreach($lines AS $line)
        {
            // only if its not a closing tag do the <br/>
            $last = substr($line, -2, -1);
            if($last != '>')
            {
                
                $retval .= nl2br($line);
            }
            else
            {
                $retval .= $line.PHP_EOL;
            }
        }
        return $retval;
    }
}