<?php
require('base.php');
$title=$GLOBALS['groups'];
$active=6;
$table='b10fb50537d357e0bcd28b904d46afa4b7a695d6';
$action='755084a108fdfcd60abd95388cfcce04c1b80574';
generateBase();

echo '
<div class="center">
<button value="REFRESH" onclick=IDU("pok","c7f588235eb4d781000efad2e6ace6c60b7a63ef","","26b56c1bdfb048c3e46419fde332bab76deb2cd3","")> Refresh </button>
<button value="Select" onclick=IDU("pok","b10fb50537d357e0bcd28b904d46afa4b7a695d6",$("input[name=what]:checked").val(),"81448fe273247b533b9f018e96c158cab7901247",$("input[name=value]:text").val())> SELECT </button>
  <input type="text"  name="value"><p>
  <input type="radio" name="what" value="nazov"> ' . $GLOBALS['groups'] . '
  <input type="radio" name="what" value="mail_male"> ' . $GLOBALS['mail'] . '</p>
</div>
<p id="pok"> </p>

<p class="center"><input type="submit" name="btn1" id = "btntest1" value='.$GLOBALS['add'].' /> <input type="submit" name="btn2" id = "btntest2" value='.$GLOBALS['remove'].' /></p>

<script>
function getCheckboxesValues(){
    return [].slice.apply(document.querySelectorAll("input[type=checkbox]"))
           .filter(function(c){ return c.checked; })
           .map(function(c){ return c.value; });
}

document.getElementById("btntest1").addEventListener("click", function(){
    IDU("pok","add",getCheckboxesValues(),"fa119f8dd2bd5910063d13016a3ad5909aebf2d8",$("input[name=group]:text").val())
});
document.getElementById("btntest2").addEventListener("click", function(){
    IDU("pok","db99845855b2ecbfecca9a095062b96c3e27703f",getCheckboxesValues(),"fa119f8dd2bd5910063d13016a3ad5909aebf2d8",$("input[name=group]:text").val())
});
</script>';

?>

</body>
</html>