<?php

    $var = '20/04/2012';
    $date = str_replace('/', '-', $var);
    echo date('Y-m-d', strtotime($date));

?>