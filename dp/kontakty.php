<?php
require('base.php');
$title = $GLOBALS['contacts'];
$active = 3;
$table='c7f588235eb4d781000efad2e6ace6c60b7a63ef';
$action='755084a108fdfcd60abd95388cfcce04c1b80574';
generateBase();

echo '
<div class="center"><p>
<button value="REFRESH" onclick=IDU("pok","c7f588235eb4d781000efad2e6ace6c60b7a63ef","","26b56c1bdfb048c3e46419fde332bab76deb2cd3","")> Refresh </button>
<button value="Select" onclick=IDU("pok","c7f588235eb4d781000efad2e6ace6c60b7a63ef",$("input[name=what]:checked").val(),"81448fe273247b533b9f018e96c158cab7901247",$("input[name=value]:text").val())> ' . $choice . ' </button>
  <input type="text"  name="value">
  <input type="radio" name="what" value="pred"> ' . $GLOBALS['title_before'] . '
  <input type="radio" name="what" value="meno"> ' . $GLOBALS['name'] . '
  <input type="radio" name="what" value="priezvisko"> ' . $GLOBALS['surname'] . '
  <input type="radio" name="what" value="za"> ' . $GLOBALS['title_for'] . '
  <input type="radio" name="what" value="mail_male"> ' . $GLOBALS['mail'] . '
  <input type="radio" name="what" value="poslat"> ' . $GLOBALS['send'] . '
  <input type="radio" name="what" value="vymazany"> ' . $GLOBALS['removed'] . '</p><p>
<button value="Select" onclick=IDU("pok","0a6f9261151d3dd3d2500ea02569507190f758f3","","81448fe273247b533b9f018e96c158cab7901247")> ' . $duplication . ' </button>
 ' . $original . ' <input type="text"  name="id1" placeholder="id" style=\'width:25px;\' >
 ' . $new . ' <input type="text"  name="id2" placeholder="id" style=\'width:25px;\' >
<button value="Select" onclick=IDU("pok","19df8f17ab68ff0db9f639200b8e7a8b69cce3c2",$("input[name=id1]:text").val(),$("input[name=id2]:text").val())> ' . $replace . ' </button></p>
</div>

<p id="pok"> </p>
';
?>
</body>
</html>