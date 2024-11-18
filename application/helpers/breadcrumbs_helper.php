<?php
if (!function_exists('set_breadcrumb')) {
    function set_breadcrumb($crumbs = array())
    {
        $output = '<ol class="breadcrumb">';
        $total = count($crumbs);
        $i = 1;

        foreach ($crumbs as $crumb => $link) {
            if ($i == $total) {
                $output .= '<li class="breadcrumb-item active">' . $crumb . '</li>';
            } else {
                $output .= '<li class="breadcrumb-item"><a href="' . $link . '">' . $crumb . '</a></li>';
            }
            $i++;
        }

        $output .= '</ol>';
        return $output;
    }
}
?>
