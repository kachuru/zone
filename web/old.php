<?php
require_once '../vendor/autoload.php';

use Kachuru\Zone\Map\MapDisplay;
?>
    <head>
        <style type="text/css">
            body {
                font-family: sans-serif;
                font-size: 5pt;
            }

            div#map {
                float: left;
                padding: 10px;
            }

            div.tile-outer {
                height: 77px;
                width: 91px;
                position: absolute;
            }

            div.tile-outer_small {
                height: 77px;
                width: 91px;
                position: absolute;
            }

            div.tile-inner {
                height: 77px;
                width: 50px;
                margin: auto;
                line-height: 6.4;
                text-align: center;
                cursor: hand;
            }

            div.tile-inner_small {
                height: 77px;
                width: 50px;
                margin: auto;
                line-height: 6.4;
                text-align: center;
                cursor: hand;
            }

            div.tile-water {
                background: url(images/tiles.png) 0 0;
            }

            div.tile-barren {
                background: url(images/tiles.png) -182px 0;
            }

            div.tile-clear {
                background: url(images/tiles.png) -91px 0;
            }
        </style>
    </head>

    <body>

    <div id="map">

<?php
$tileHtml = <<<HTML
    <div id="t%d-outer" class="tile-outer tile-%s" style="left: %dpx; top: %dpx;">
        <div id="t%d-inner" class="tile-inner" onClick="alert('T%d')">T%d</div>
    </div>
HTML;

(new MapDisplay($tileHtml))
    ->render(272);

?>