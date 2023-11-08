<?php 
    if(isset($_POST['button'])) { 
        login($_POST['name'], $_POST['password']); 
    }
    function login($name, $password){
        echo "Eimai alogo";
    }
?>