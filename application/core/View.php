<?php

class View
{
	//public $template_view; 
	
	function generate($content_view, $template_view, $data = null)
	{
	
		// if(is_array($data)) {
		// 	
		// 	extract($data);
		// }
	
		include_once 'application/views/'.$template_view;
        // include 'application/views/'.$content_view;
	}

}

