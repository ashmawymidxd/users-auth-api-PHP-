<?php
// function to generate random password
function generate_password($length = 10)
{
    $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
              '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
    $str = '';
    $max = strlen($chars) - 1;

    for ($i=0; $i < $length; $i++)
        $str .= $chars[random_int(0, $max)];

    return $str;
}

/*
function take tow password and matched them and check if they are matched or not and check 
if the passowrd complexity is valid or not and length and finally return true or false return 
true if matched and false if not matched
*/

function check_password($password1,$password2)
{
    if($password1 == $password2){
        $uppercase = preg_match('@[A-Z]@', $password1);
        $lowercase = preg_match('@[a-z]@', $password1);
        $number    = preg_match('@[0-9]@', $password1);
        $specialChars = preg_match('@[^\w]@', $password1);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 8) {
            return '1)-passowrd must be at least 8 characters in length 2)-must contain at least one number, 3)-one upper case letter, 4)-one lower case letter 5)-and one special character';
        }else{
            return 'Password matched';
        }
    }
    else{
        return 'Password not matched';
    }
}
