<?php
//include_once 'Math/BigInteger.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
//set_include_path('./phpseclib/');

include('Net/SFTP.php');
include 'databaza.php';
include 'idu_custom.php';

//error_reporting(E_ERROR);

set_time_limit(500);
$sftp = new Net_SFTP('st.fri.uniza.sk');
if (!$sftp->login('durnek1', 'L2443RJTB8')) {
    exit('Login Failed');
}
else {
    //echo 'Login success ';
}

if($fileContents = $sftp->nlist('/home/durnek1/Maildir/cur/')) {
    foreach ($fileContents as $file) {
        if ($file !== '.' && $file !== '..') {
           // echo $sftp->get('/home/durnek1/Maildir/cur/'.$file);
            $mailContent = $sftp->get('/home/durnek1/Maildir/cur/'.$file);
            //echo $mailContent;
            //if(strpos($mailContent,'550 5.1.1')) echo 'OK'; else echo 'KO';

            $posRecipient = strrpos($mailContent,'Subject',-1);
            //echo substr($mailContent,$posRecipient,-12);
            $mailAddress =  between_last('To:', 'Subject', $mailContent);
            $mailAddress = trim($mailAddress);   //odstranim biele znaky zo zaciatku a z konca

            if(substr($mailAddress,0,1) == '<'){         //odstranim aj zobaciky z niektorych mailov
                $mailAddress = substr($mailAddress,1,strlen($mailAddress)-2);
            }
            //var_dump(strpos($mailAddress,'@'));
            //var_dump($mailAddress);

            if(strpos($mailContent,'554 5.7.1') !== false) {

                if(strpos($mailAddress,'@')!== false){
                    echo $mailAddress;
                    //updateNonExistingMail($dbconn4, $mailAddress);
                    updateSpam($dbconn4, $mailAddress);
                }else{
                    echo 'invalid email address';
                }
                //echo $sftp->get('/home/durnek1/Maildir/cur/'  . $file);
                echo '<br><br> ======= <br><br>';}
//            }elseif(strpos($mailContent,'554 5.7.1') !== false)
//            {
//                if(strpos($mailAddress,'@')!== false){
//                    echo $mailAddress;
//                    updateSpam($dbconn4, $mailAddress);
//                }else{
//                    echo 'invalid email address';
//                }
//                echo '<br><br> !!!!!!!!!! <br><br>';
//            }else
//            {
//                echo '<br><br>this mail is correct<br><br>';
//            }
        }
    }
} else {
    echo 'cannot read emails';
}

function between_last ($this1, $that, $inthat)
{
    return after_last($this1, before_last($that, $inthat));
};

function after_last ($this1, $inthat)
{
    if (!is_bool(strrevpos($inthat, $this1)))
        return substr($inthat, strrevpos($inthat, $this1)+strlen($this1));
};

function before_last ($this1, $inthat)
{
    return substr($inthat, 0, strrevpos($inthat, $this1));
};

function strrevpos($instr, $needle)
{
    $rev_pos = strpos (strrev($instr), strrev($needle));
    if ($rev_pos===false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};
?>