<?php
function muestraBoton($numEj):void
{
    $link = "#ej0".$numEj;
    echo "
        <a href='$link'. style='
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 15px 32px;        
        '>Ej$numEj</a>
        
    ";


}

