<?php
class View
{
	function generate($content_view, $template_view = null, $params = null)
	{
		if ($template_view) {
			include 'application/views/'.$template_view;
		} else {
			include 'application/views/'.$content_view;
		}
	}
}