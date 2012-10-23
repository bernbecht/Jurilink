<?php

function mascaraTelefone($string) {


    if (strlen($string) == 11) {
        $tele = $pessoa->tel;
        echo "(";
        for ($i = 0; $i < 11; $i++) {
            if ($i == 3)
                echo ") ";
            echo $tele[$i];
            if ($i == 6)
                echo "-";
        }
    }

    else if (strlen($string) == 10) {
        $tele = $pessoa->tel;
        echo "(";
        for ($i = 0; $i < 10; $i++) {
            if ($i == 2)
                echo ") ";
            echo $tele[$i];
            if ($i == 5)
                echo "-";
        }
    }

    else if (strlen($string) == 8) {
        $tele = $pessoa->tel;
        for ($i = 0; $i < 8; $i++) {
            echo $tele[$i];
            if ($i == 3)
                echo "-";
        }
    }
}

?>
