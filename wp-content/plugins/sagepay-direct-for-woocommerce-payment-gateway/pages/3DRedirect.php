<?php

    session_start();


    $res =  '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' .
            '<html><head>' .
            '<script type="text/javascript"> function OnLoadEvent() { document.form.submit(); }</script>' .
            '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />' . 
            '<title>3D-Secure Redirect</title>' .             
            '</head>' . 
            '<body OnLoad="OnLoadEvent();">' .
            '<form name="form" action="' . $_SESSION['ACSURL'] . '" method="POST" >' .
            '<input type="hidden" name="PaReq" value="' . $_SESSION['PAReq'] . '"/>' .
            '<input type="hidden" name="MD" value="' . $_SESSION['MD'] . '"/>' .
            '<input type="hidden" name="TermUrl" value="' . $_SESSION['TermURL'] . '"/>' .
            '<noscript>' .
            '<center><p>Please click button below to Authenticate your card</p><input type="submit" value="Go"/></p></center>' .
            '</noscript>' .
            '</form></body></html>';

    //iframe content
    echo $res;
    
    //remove PAReq
    unset($_SESSION["PAReq"]);
?>