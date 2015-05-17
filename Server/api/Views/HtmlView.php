<?php

	namespace Views;

	class HtmlView extends BaseView
	{
		public function __construct()
		{
			header(HEADER_HTML);
		}
		private function htmlEncode($data)
		{
			$response = '<table border=1>';

			foreach($data as $item)
			{
				$response .= '<tr>';

				if(is_array($item))
				{
					foreach($item as $value)
					{
						$response .= '<td>' . $value . '</td>';
					}
				}
				else
				{
					$response .= '<td>' . $item . '</td>';
				}


				$response .= '</tr>';
			}

			return $response . '</table>';
		}
		public function response($responseContent)
		{
            echo $this->htmlEncode($responseContent);
		}

		public function responseError(
			\Models\Utilities\RestException $exception)
		{
			parent::sendErrorHeader($exception);

			echo '<p>' . $exception . '</p>';
		}
	}
