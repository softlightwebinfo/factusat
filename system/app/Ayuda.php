<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 22/03/2017
 * Time: 1:13
 */
class Ayuda
{
    public function __construct()
    {
    }

    public static function reverseDate($date, $format = "Y-m-d")
    {
        if ($date === "000-00-00" OR $date === "" OR is_null($date)) {
            return "";
        }
        $reverse = self::remplazar($date, "-", "/");
        $date = new DateTime($reverse);
        return $date->format($format);
    }

    public static function reverseDateMysql($date, $format = "Y-m-d")
    {
        $reverse = self::remplazar($date, "-", "/");
        $explod = explode("-", $reverse);
        $dia = $explod[0];
        $mes = $explod[1];
        $anio = $explod[2];
        $fecha = "{$anio}-{$mes}-$dia";
        $date = new DateTime($fecha);
        return $date->format($format);
    }

    public static function remplazar(string $string, $remplazar, $search = "")
    {
        return str_replace($search, $remplazar, $string);
    }

    public static function array_separate(array $array, $delimitado = null)
    {
        $datos = "";
        foreach ($array as $key => $row) {
            $datos .= "'{$row}'{$delimitado}";
        }
        $datos = trim($datos, $delimitado);
        return $datos;
    }

    public static function sendEmail($titulo, $body, $address, $address_name, callable $callback = null)
    {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = EMAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASSWORD;
        $mail->SMTPSecure = 'tls';
        $mail->Port = EMAIL_PORT;
        $mail->setFrom(EMAIL_FROM, EMAIL_NOMBRE);
        $mail->addAddress($address, $address_name);
        $mail->isHTML(true);
        $mail->Subject = $titulo;
        $mail->Body = $body;
        if (!is_null($callback)) {
            $callback($mail);
        }
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    public static function hace($date)
    {
        $time = new DateTime($date);
        $time = $time->getTimestamp();
        $delta = time() - $time;

        if ($delta < 1 * MINUTE) {
            return $delta == 1 ? "en este momento" : "hace " . $delta . " segundos ";
        }
        if ($delta < 2 * MINUTE) {
            return "hace un minuto";
        }
        if ($delta < 45 * MINUTE) {
            return "hace " . floor($delta / MINUTE) . " minutos";
        }
        if ($delta < 90 * MINUTE) {
            return "hace una hora";
        }
        if ($delta < 24 * HOUR) {
            return "hace " . floor($delta / HOUR) . " horas";
        }
        if ($delta < 48 * HOUR) {
            return "ayer";
        }
        if ($delta < 30 * DAY) {
            return "hace " . floor($delta / DAY) . " dias";
        }
        if ($delta < 12 * MONTH) {
            $months = floor($delta / DAY / 30);
            return $months <= 1 ? "el mes pasado" : "hace " . $months . " meses";
        } else {
            $years = floor($delta / DAY / 365);
            return $years <= 1 ? "el a&ntilde;o pasado" : "hace " . $years . " a&ntilde;os";
        }
    }

    public static function time_passed($date)
    {
        $fecha = new DateTime($date);
        $date = $fecha->getTimestamp();
        $diff = time() - (int)$date;

        if ($diff < 20) {
            $return = 'Ahora mismo';
        } else if ($diff >= 20 AND $diff < 60) {
            $return = sprintf('hace %s segundos.', $diff);
        } else if ($diff >= 60 AND $diff < 120) {
            $return = sprintf('hace %s minuto.', floor($diff / 60));
        } else if ($diff >= 120 AND $diff < 3600) {
            $return = sprintf('hace %s minutos.', floor($diff / 60));
        } else if ($diff >= 3600 AND $diff < 7200) {
            $return = sprintf('hace %s hora.', floor($diff / 3600));
        } else if ($diff >= 7200 AND $diff < 86400) {
            $return = sprintf('hace %s horas.', floor($diff / 3600));
        } else if ($diff >= 86400 AND $diff < 172800) {
            $return = sprintf('hace %s dia.', floor($diff / 86400));
        } else if ($diff >= 172800 AND $diff < 604800) {
            $return = sprintf('hace %s dias.', floor($diff / 86400));
        } else if ($diff >= 604800 AND $diff < 1209600) {
            $return = sprintf('hace %s semana.', floor($diff / 604800));
        } else if ($diff >= 1209600 AND $diff < 2629744) {
            $return = sprintf('hace %s semanas.', floor($diff / 604800));
        } else if ($diff >= 2629744 AND $diff < 5259488) {
            $return = sprintf('hace %s mes.', floor($diff / 2629744));
        } else if ($diff >= 5259488 AND $diff < 31556926) {
            $return = sprintf('hace %s meses.', floor($diff / 2629744));
        } else if ($diff >= 31556926 AND $diff < 63113852) {
            $return = sprintf('hace %s año.', floor($diff / 31556926));
        } else if ($diff >= 63113852) {
            $return = sprintf('hace %s años.', floor($diff / 31556926));
        } else {
            $return = date('H:i:s d/m/Y', $timestamp);
        }

        return $return;
    }

    public static function diaDeLaSemana($date = null)
    {
        if (!is_null($date)) {
            $fecha = new DateTime($date);
            $year = $fecha->format("Y");
            $month = $fecha->format("m");
            $day = $fecha->format("d");
        } else {
            $year = date("Y");
            $month = date("m");
            $day = date("d");
        }


        $semana = date("W", mktime(0, 0, 0, $month, $day, $year));

        $diaSemana = date("w", mktime(0, 0, 0, $month, $day, $year));

        if ($diaSemana == 0)
            $diaSemana = 7;

        $primerDia = date("d-m-Y", mktime(0, 0, 0, $month, $day - $diaSemana + 1, $year));

        $primerDia = new DateTime($primerDia);
        $ultimoDia = date("d-m-Y", mktime(0, 0, 0, $month, $day + (7 - $diaSemana), $year));
        $ultimoDia = new DateTime($ultimoDia);

        return array(
            "primer" => array(
                "completo" => $primerDia,
                "dia" => $primerDia->format("d"),
                "mes" => $primerDia->format("m"),
                "anio" => $primerDia->format("Y"),
                "completoForm" => $primerDia->format("Y-m-d"),
            ),
            "ultimo" => array(
                "completo" => $ultimoDia,
                "dia" => $ultimoDia->format("d"),
                "mes" => $ultimoDia->format("m"),
                "anio" => $ultimoDia->format("Y"),
                "completoForm" => $ultimoDia->format("Y-m-d"),
            ),
            "semana" => $semana,
            "dia" => $day,
            "mes" => $month,
            "anio" => $year
        );
    }

    public static function dateFormat($date, $format = "Y-m-d")
    {
        try {
            if (empty($date)) {
                throw new Exception("Error campo vacio", 1);
            }
            $fecha = new DateTime($date);
            $date = $fecha->format("d/m/Y");
            return $date;
        } catch (Exception $exception) {
            return "";
        }
        return $date;
    }

    public static function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false)
    {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }

    public static function urlAmigable($url)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $url);
        $slug = strtolower($slug);
        return $slug;
    }

    public static function fileExist($url)
    {
        if (!is_file($url)) return false;
        return true;
    }
}