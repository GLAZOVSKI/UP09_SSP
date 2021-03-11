<?php
class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.

	function generate($content_view, $template_view, $data = null)
	{
		/*
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/

		include 'application/views/'.$template_view;
	}

	function redirect($redirect_name, $message = null) {
		if (isset($message)) {
			session_start();
 		 	$_SESSION['message'] = $message;
		}

		header("Location: $redirect_name");
	}
}
