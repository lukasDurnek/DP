<?php
require('base.php');
$title = $GLOBALS['analyzed_mails'];
$active = 12;
$table='unexistingEmails';
$action='755084a108fdfcd60abd95388cfcce04c1b80574';
generateBase();

//echo '
//    <div class = "center">
//    <form method="POST" >
//  <select id="cmbAnalyze" name="analyze"     onchange="document.getElementById(\'selected_text\').value=this.options[this.selectedIndex].text">
//     <option value="0">' . $GLOBALS['typeMails'] . '</option>
//     <option value="1">' . $GLOBALS['unexistingMails'] . '</option>
//     <option value="2">' . $GLOBALS['spam'] . '</option>
//</select>
//<input type="hidden" name="selected_text" id="selected_text" value="" />
//<input type="submit" name="showEmails" value=' . $GLOBALS['show'] . '>
//</form>
//</div>
//
//';


echo '
        <div class="center"><p>
            <p><h2>' . $GLOBALS['unexistingMails'] . '</h2></p>
            <button value="REFRESH" onclick=IDU("pok","unexistingEmails","","26b56c1bdfb048c3e46419fde332bab76deb2cd3","")> Refresh </button>
            <button value="Select" onclick=IDU("pok","unexistingEmails",$("input[name=what]:checked").val(),"81448fe273247b533b9f018e96c158cab7901247",$("input[name=value]:text").val())> ' . $choice . ' </button>
        <input type="text"  name="value">
        <input type="radio" name="what" value="meno"> ' . $GLOBALS['name'] . '
        <input type="radio" name="what" value="priezvisko"> ' . $GLOBALS['surname'] . '
        <input type="radio" name="what" value="mail"> ' . $GLOBALS['mail'] . '</p><p></p>
        </div>

        <p id="pok"> </p>
';


//if(isset($_POST['showEmails']))
//{
//    $makerValue = $_POST['analyze']; // make value
//    if($makerValue == 1){
//
//
//    }elseif ($makerValue == 2){
//        //TODO
//    }else{
//        echo "<script>alert('NEVYBRAL SI ZIADNU MOZNOST');</script>";
//    }
//
//}

?>