<?php

class RPS_Helpers_Clean
{

    public static function date ($date)
    {

        $dat = ($date == "0000-00-00") ? "" : $date;
        return $dat;
    }

    public static function Zero ($zero)
    {

        $value = ($zero == "0") ? "" : round($zero, 2);
        return $value;
    }

    public static function Obra ($value)
    {

        $clean = (empty($value)) ? "N/A" : $value;
        return $clean;
    }

    public static function Origem ($value)
    {

        switch ($value) {
            case 'Reclamacao':
                return "Reclamação";
                break;
            case 'Seguranca':
                return "Segurança";
                break;
            default:
                return $value;
                break;
        }
    }
    
    
    public static function estado($value)
    {
        
        switch ($value) {
            case 0:
                return "Aberta";
            break;
            
            case 1:
                return "Fechada";
            break;
        }
        
    }
}
?>