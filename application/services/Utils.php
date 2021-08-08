<?php

// class for check ajax - requests

class Utils {

    public static function is_ajax(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
			return true;
		}

    }

}