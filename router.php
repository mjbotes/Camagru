<?php

class Router
{

	static public function parse($url, $request)
	{
		$url = trim($url);
		$request->controller = "auth";
		$request->action = "login";
		$request->params = [];
		if ($url != '/Camagru/Public/')
		{
			$explode_url = explode('/', $url);
			$explode_url = array_slice($explode_url, 3);
			$request->controller = $explode_url[0];
			$request->action = $explode_url[1];
			$request->params = array_slice($explode_url, 2);
		}
	}
}
?>
