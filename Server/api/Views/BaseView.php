<?php

	namespace Views;

	abstract class BaseView
	{
		abstract public function response($responseContent);
		abstract public function responseError();
	}