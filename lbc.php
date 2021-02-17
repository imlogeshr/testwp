<?php
/*
Plugin Name: WP Test Plugin
*/

function ip_info($ip = NULL, $purpose = "country_code", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipwhois_result = @json_decode(file_get_contents("http://ipwhois.app/json/" . $ip));
        if (@strlen(trim($ipwhois_result->geoplugin_countryCode)) == 2) 
		$cc=@$ipwhois_result->geoplugin_country_code{
            switch ($cc) {
                case 'IN':
				$content = 'Weloceme to India';
				break;
				case 'US':
				$content = 'Welcome to United States';
				break;
				case 'FR':
				$content = 'Weloceme to France';
				break;
				case 'GE':
				$content = 'Weloceme to Germany';
				break;
				case 'IT':
				$content = 'Weloceme to Italy';
				break;
				case 'UK':
				$content = 'Weloceme to United Kingdom';
				break;
				case 'JP':
				$content = 'Weloceme to Japan';
				break;
				case 'CA':
				$content = 'Weloceme to Canada';
				break;  
            }
        }
    }
    echo '<div>'.$content.'</div>';
}

?>
