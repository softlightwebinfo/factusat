<?php
    function time_longTime($antes, $date = null)
    {
        $dt1 = new DateTime($antes);

        $data = date("Y-m-d H:i:s");
        $dt2 = new DateTime($data);
        $i = $dt1->diff($dt2);

        if ($date) {

            return array(
                "dias" => $i->format('%a'),
                "horas" => $i->format('%h'),
                "minutos" => $i->format('%i'),
                "segundos" => $i->format('%s')
            );
        } else {
            echo $i->format('quedan %a dias %h horas %i minuto(s) %s segundo(s)');
        }
        //quedan 2 dias 13 horas 1 minuto(s) 1 segundo(s)
    }

?>
