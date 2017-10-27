<?php

include 'databaza.php';
include 'idu_custom.php';

/* connect to gmail */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'pracabakalarka@gmail.com';
$password = '554452554452';

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());


/*$mailbox1 = "nonexisting";
$r_name = imap_utf7_encode("tralalala");
$new_name = $mailbox1;

echo "Newname will be '$mailbox1'<br />\n";

// we will now create a new mailbox "phptestbox" in your inbox folder,
// check its status after creation and finally remove it to restore
// your inbox to its initial state

if(@imap_createmailbox($inbox,imap_utf7_encode("$hostname.$mailbox1"))){
    $status = @imap_status($inbox,"$hostname.$new_name", SA_MESSAGES);
    if($status){
            echo "your new mailbox '$mailbox1' has the following status:<br />\n";
            if(isset($messages))
                echo "abc";
        echo "Messages:   " . $status->messages    . "<br />\n";
       // echo "Recent:     " . $status->recent      . "<br />\n";
       // echo "Unseen:     " . $status->unseen      . "<br />\n";

        if (imap_renamemailbox($inbox, "$hostname.$new_name","$hostname.$r_name")){
                echo "renamed new mailbox from '$mailbox1' to '$r_name'<br />\n";
            $new_name = $r_name;
        }else{
                echo "imap_renamemailbox on new mailbox failed: " . imap_last_error() . "<br />\n";
        }
    } else {
                echo "imap_status on new mailbox failed: " . imap_last_error() . "<br />\n";
    }

    /*if(@imap_deletemailbox($inbox,"$hostname.$new_name")){
                echo "new mailbox removed to restore initial state<br />\n";
    }else{
                echo "imap_deletemailbox on new mailbox failed: " . implode("<br />\n", imap_errors()) . "<br />\n";
    }

} else {
    echo "could not create new mailbox: " . implode("<br />\n", imap_errors()) . "<br />\n";
}*/



//$boxes = imap_list($inbox, $hostname, '*');
//
//print_r($boxes);




/* grab emails */
$emails = imap_search($inbox,'ALL',SE_FREE,'UTF-8');       //vygooglit imap_search php dokumentaciu a co davam do param, zaujimaju ma criteria

/* if emails are returned, cycle through each... */
if($emails) {

/* begin output var */
$output = '';

/* put the newest emails on top */
rsort($emails);

/* for every email... */
foreach($emails as $email_number) {

    /* get information specific to this email */
    $overview = imap_fetch_overview($inbox,$email_number,0);
    $message = imap_fetchbody($inbox,$email_number,2);


    //if(strpos($message,'550 5.1.1')) echo 'OK'; else echo 'KO';
    $posRecipient = strrpos($message,': Recipient',-1);
    $mailAddress =  between_last('550 5.1.1', ': Recipient', $message);
    $mailAddress = trim($mailAddress);   //odstranim biele znaky zo zaciatku a z konca
    if(substr($mailAddress,0,1) == '<'){         //odstranim aj zobaciky z niektorych mailov
        $mailAddress = substr($mailAddress,1,strlen($mailAddress)-2);
    }

    if(strpos($message,'550 5.1.1') !== false) {

        if(strpos($mailAddress,'@')!== false){
            echo $mailAddress;
            updateNonExistingMail($dbconn4, $mailAddress);
            //updateSpam($dbconn4, $mailAddress);
        }else {
            echo 'invalid email address';
        }
        echo '<br><br> ======= <br><br>';
    }


    /* output the email header information */
    //$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
    //$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
    //$output.= '<span class="from">'.$overview[0]->from.'</span>';
    //$output.= '<span class="date">on '.$overview[0]->date.'</span>';
    //$output.= '</div>';

    /* output the email body */
    //$output.= '<div class="body">'.$message.'</div>';
    //echo $output;
    break;
}

echo $output;
}

/* close the connection */
imap_close($inbox);



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