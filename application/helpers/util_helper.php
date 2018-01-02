<?php 
    if(!function_exists('_log')) {
    function _log($var) {
        $CI =& get_instance();
        /*$clase = $CI->router->fetch_class();
         $metodo = $CI->router->fetch_method();*/
        $dbgt = debug_backtrace();
        if(isset($dbgt[1]['class'])) {
            $class = $dbgt[1]['class'];
        } else {
            $ruta = explode(DIRECTORY_SEPARATOR, $dbgt[0]['file']);
            $class = end($ruta);
        }
        log_message('error', '( '.$class.' -> '.$dbgt[1]['function'].') (linea: '.$dbgt[0]['line'].') >> '.$var);
    }
}

if(!function_exists('_logLastQuery')) {
    /**
     * Valida si es entero
     * @param $input - valor a evaluar
     * @return bool true / false
     */
    function _logLastQuery($marca = null) {
        $CI =& get_instance();
        /*$clase = $CI->router->fetch_class();
         $metodo = $CI->router->fetch_method();*/
        $dbgt = debug_backtrace();
        log_message('error', '( '.$dbgt[1]['class'].' -> '.$dbgt[1]['function'].') (linea: '.$dbgt[0]['line'].') >> '.$marca.' - '.$CI->db->last_query());
    }
}
 ?>