<?php

	namespace Views;

	class XmlView extends BaseView
    {
        public function response($responseContent)
        {
            $response = new DOMDocument('1.0', 'utf-8');


        }
        public function responseError()
		{

		}
	}
