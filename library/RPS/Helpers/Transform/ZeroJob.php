<?php

/** 
 * @author rpsimao
 * 
 */
class RPS_Helpers_Transform_ZeroJob
{
    public static function remove($val)
    {
        
        switch ($val) {
            case 0:
             return "---";
            break;
            
            default:
                return $val;
            break;
        }
    }
}

?>