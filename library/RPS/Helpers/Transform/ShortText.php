<?php
/** 
 * @author rpsimao
 * 
 * 
 */
class RPS_Helpers_Transform_ShortText
{
     /**
     * Reduz o tamanho do nome do ficheiro para x caracteres
     * 
     * @param string $text
     * @param int $chars
     */
    public static function reduce ($text, $chars = 20)
    {

        $length = strlen($text);
        $text = strip_tags($text);
        $text = substr($text, 0, $chars);
        if ($length > $chars) {
            $text = $text . "...";
        }
        return $text;
    }
}
?>