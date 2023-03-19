<?php
    require_once "Renderable.php";

    function renderList($items)
    {
        $output = "<div>\n<ul>\n";
        foreach($items as $item)
        {
            $output .= "<li>\n" . $item->renderHtml() . "\n</li>\n";
        }
        $output .="</ul>\n</div>";

        return $output;
    }
?>