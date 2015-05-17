<?php

	namespace Views;

	class XmlView extends BaseView
    {
		private $writer;

		public function __construct()
		{
			$this->writer = new \XMLWriter();
		}

		private function getXML($data)
		{
			foreach($data as $key => $value)
			{
				if(is_numeric($key))
				{
					$key = 'item' . $key;
				}

				if(is_array($value))
				{
					$this->writer->startElement($key);
					$this->getXML($value);
					$this->writer->endElement();
				}
				else
				{
					$this->writer->writeElement($key, $value);
				}
			}
		}
		private function xmlEncode($data)
		{
			$this->writer->openMemory();
			$this->writer->startDocument('1.0', 'utf-8');
			$this->writer->startElement('response');

			if(is_array($data))
			{
				$this->getXML($data);
			}

			$this->writer->endElement();

			return $this->writer->outputMemory();
		}
        public function response($responseContent)
        {
            header(HEADER_XML);

	        echo $this->xmlEncode($responseContent);
        }
        public function responseError()
		{

		}
	}
