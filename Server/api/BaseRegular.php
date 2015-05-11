<?php

	abstract class BaseRegular extends \BaseSingleton
	{
		/**
		 * change access modificator protected->public
		 */
		public function __construct()
		{
			parent::__construct();
		}
	}