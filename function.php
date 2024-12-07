<?php

// validate/sanitize input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function nameChecker($name){ 
    $display = '';       
    if($name == ''){
        $display = "Please provide a name";
        $GLOBALS['valid']  = false;
    } 
    elseif(strlen($name) <= 2 ) {
        $display = "Oops! your name is invalid";
        $GLOBALS['valid']  = false;
    }   
    return $display;       
}
 
function repeatPassword($password, $rpassword){
    $display = '';
    
    if($password == ''){
        $display = "Please enter a password"; 
        $GLOBALS['valid'] = false;
    }
    if($rpassword == ''){
        $display = "please enter a password";
        $GLOBALS['valid'] = false;
    }
    elseif($password != $rpassword){
        $display = 'Password doesnot match!';
        $GLOBALS['valid'] = false;
    }
    return $display;
}

?>