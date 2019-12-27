<?php

/**
 *  If you make this application for live payments then update following variable values:
 *  Change MODE from sandbox to live
 *  Update PayPal Client ID and Secret to match with your live paypal app details
 *  Change Base URL to https://api.paypal.com/v1/
 *  finally make sure that APP URL matcher to your application url
 */

define('MODE', 'sandbox');
define('CURRENCY', 'USD');
define('APP_URL', 'http://localhost/practica/paypal/');

define("PayPal_CLIENT_ID", "Afxtx2JRksTFlOhO9dchMX9vzT46S6no0a_6x8KoVSPPYH3po3qEXtja-lT5TuGQiR8i8xZRqjOwCh78");
define("PayPal_SECRET", "ECsshuDEdJEGqnWC4vWa4ZZol37hOFdV1KypQ-zpt65Ah6Rcz3VXTRFIz6Us09XJEeW1QchybxxZgVhK");
define("PayPal_BASE_URL", "https://api.sandbox.paypal.com/v1/");

?>