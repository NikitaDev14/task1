<?php

	namespace Models\Utilities;

	class RestException extends \Exception
	{
		public function __construct($message, $code,
		                            \Exception $previous = null)
		{
			parent::__construct($message, $code, $previous);
		}
		public function __toString()
		{
			return $this->message . ' '
				. $this->code . ' '
				. $this->file . ' '
				. $this->line;
		}
	}