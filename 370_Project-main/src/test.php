<?php
$p=password_hash("test", PASSWORD_BCRYPT);
if(password_verify("test",$p)){
    echo "True";
}
else{
    echo"Fasle";

}



?>