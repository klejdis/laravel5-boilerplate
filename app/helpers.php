<?php

/**
 * ----------------------------------------------------------------------------
 * This function is used to include all route files into one
 * in this way we can split the route files into multiple files
 * ----------------------------------------------------------------------------
 */

if (! function_exists('include_route_files')){
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


/**
 * ----------------------------------------------------------------------------
 * link the css files
 * ----------------------------------------------------------------------------
 * @param array $array
 * @return print css links
 */
if (!function_exists('load_css')) {

    function load_css(array $array) {
        foreach ($array as $uri) {
            echo "<link rel='stylesheet' type='text/css' href='" . asset($uri) . "' />";
        }
    }

}


/**
 * ----------------------------------------------------------------------------
 * link the javascript files
 * ----------------------------------------------------------------------------
 * @param array $array
 * @return print js links
 */
if (!function_exists('load_js')) {

    function load_js(array $array) {
        foreach ($array as $uri) {
            echo "<script type='text/javascript'  src='" . asset($uri) . "'></script>";
        }
    }

}


/**
 * prepare a anchor tag for any js request
 *
 * @param string $title
 * @param array $attributes
 * @return html link of anchor tag
 */
if (!function_exists('js_anchor')) {

    function js_anchor($title = '', $attributes = '') {
        $title = (string) $title;
        $html_attributes = "";

        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                $html_attributes .= ' ' . $key . '="' . $value . '"';
            }
        }

        return '<a href="#"' . $html_attributes . '>' . $title . '</a>';
    }

}

if (!function_exists('getPublicUrlFromPath')){
    function getPublicUrlFromPath($path = null){
        if ($path !== null){
            $exists = \Illuminate\Support\Facades\Storage::disk('public')->has($path);
            if ($exists){
                return asset('storage/'.$path);
            }
        }
    }
}

if (!function_exists('getBase64ImageFromRequest')){
    function getBase64ImageFromRequest($base64_str = null){
        if ($base64_str !== null){
            //get the base-64 from data
            $base64_str = substr($base64_str, strpos($base64_str, ",")+1);
            //decode base64 string
            $image = base64_decode($base64_str);

            return $image;
        }
    }
}
