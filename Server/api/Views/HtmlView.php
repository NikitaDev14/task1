<?php

	namespace Views;

	class HtmlView extends BaseView
	{
		public function response($responseContent)
		{
			header(HEADER_HTML);

            $response = '<table border=1>';

            foreach($responseContent as $car)
            {
                $response .= '<tr>';

                foreach($car as $value)
                {
                    $response .= '<td>' . $value . '</td>';
                }

                $response .= '</tr>';
            }

            $response .= '</table>';

            echo $response;
		}

		public function responseError()
		{

		}
	}
