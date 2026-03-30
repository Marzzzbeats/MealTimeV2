<?php

    function htmlLoginForm(){
        $form="<form action='login.php' method='POST'>";
        $form.="<p>Email : <input type='email' placeholder='example@examplemail.com' required='required' name='email' id='email'></p>";
        $form.="<p>Mot de passe : <input type='password' required='required' name='password' id='password'></p>";
        $form.="<button type='submit'>";
        $form.="</form>";
        return $form;
    }

?>