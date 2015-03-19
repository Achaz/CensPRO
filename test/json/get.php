<?php

    // $params = $_GET;
// 
    // print_r($params['one']);
    // print_r($params['two']);
    // print_r($params['three']);
    
    $posted_data = array();
    if (!empty($_POST['json'])) {
        $posted_data = json_decode($_POST['json'], true);
    }
    print_r($posted_data);
?>