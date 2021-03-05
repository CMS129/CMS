<?php 
require 'app/Inlet.php';

if (!extension_loaded("openssl")) {
    exit("Please open the openssl extension first.");
}

Api::session()->Session();

Api::start();
