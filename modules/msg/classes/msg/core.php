<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Message notification helper
 * Consists of 5 type of messages:
 *  - Alert
 *  - Error
 *  - Notice
 *  - Success
 *  - Warning
 * 
 * Can automatically render all the messages to user
 *  
 * @author Martin Dubbelman
 * @package Nabob/Msg
 */
class Msg_Core{
	
	const ALERT		= 'alert';
	const ERROR		= 'error';
	const NOTICE	= 'notice';
	const SUCCESS	= 'success';
	const WARNING	= 'warning';	
	
	protected $_config;
	
	protected static $_instance = NULL;
	
	protected $_messages = NULL;
	
	/**
	 * 
	 * @return Msg
	 */
	public static function instance()
	{
		if( Msg::$_instance === NULL )
			Msg::$_instance = new Msg();
		
		return Msg::$_instance;		
	}
	
	protected function __construct($config = NULL )
	{
		if( $config === NULL )
			$this->_config = Kohana::config('message');
		else
			$this->_config = $config;
	}
	
	public function set( $type, $message, $key = NULL )
	{
		// first get all the messages
		$messages = $this->_get();
		
		if( empty( $messages[$type] ) || ! is_array( $messages[$type] ) )
			$messages[$type] = array();
			
		if( $key === NULL )
			$messages[$type][] = $message;
		else
			$messages[$type][$key] = $message;
			
		$this->_set($messages);

		return $this;
	}
	
	public function get( $type = NULL, $key = NULL, $default = NULL, $delete = FALSE )
	{
		$orig_messages = $this->_get();
		
		if( empty( $orig_messages ) )
			return array();
			
		elseif( $type === NULL && $key === NULL )
		{
			// delete all messages
			if( $delete == TRUE )
				$this->_set(array());
				
			return $orig_messages;
		}
		else 
		{
			$messages = Arr::get($orig_messages, $type, array());
			
			if( $key == NULL )
			{
				unset( $orig_messages[$type]);
				$this->_set($orig_messages);
				
				return $messages;
			}
			else 
			{
				foreach( $messages as $index => $message )
				{
					if( $index === $key )
					{
						unset( $orig_messages[$type][$key]);
						$this->_set($orig_messages);
						
						return $message;
					}
				}
			}
		}
		
		return $default;
	}
	
	/**
	 * 
	 * Delete messages
	 */
	public function delete( $type = NULL )
	{
		$this->get( $type, NULL, NULL, TRUE );
		return $this;
	}
	
	public function get_once($type = NULL, $key = NULL, $default = NULL )
	{
		return $this->get( $type, $key,$default, TRUE );
	}
	
	//private function _delete($)
	
	private function _set( $messages )
	{
		$this->_messages = $messages;
		Session::instance()->set($this->_config['key'], $messages );
	}
	
	/**
	 * 
	 * Return all stored messages
	 */
	private function _get()
	{
		return Session::instance()->get($this->_config['key']);	
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param string $type Type of message, default all messages
	 * @param boolean $delete delete the message afterwards? Default TRUE 
	 * @param string $view The view to render, default is 'msg/default'
	 */
	public function render($type = NULL, $delete = TRUE, $view = NULL)
	{
		if (($messages = $this->get($type, NULL, NULL, $delete)) === NULL)
		{
			// Nothing to render
			return '';
		}
		
		// simplify the array
		$new_messages = array();
		foreach( $messages as $type => $message )
		{
			foreach( $message as $msg )
			{
				$new_messages[] = array( 'type' => $type, 'text' => $msg );
			}
		}
		
		if ($view === NULL)
		{
			// Use the default view
			$view = 'msg/default';
		}
		
		if ( ! $view instanceof Kohana_View)
		{
			// Load the view file
			$view = new View($view);
		}
		
		// Return the rendered view
		return $view->set('messages', $new_messages)->render();
	}

	
}
