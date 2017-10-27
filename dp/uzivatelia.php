<?php
require('base.php');
$title=$GLOBALS['users'];
$active=5;
$table='0c25d1a648a3363fe30cad4541eac805b4cae5fd';
$action='755084a108fdfcd60abd95388cfcce04c1b80574';
generateBase();

echo '
<div class="center">
<button value="REFRESH" onclick=IDU("pok","c7f588235eb4d781000efad2e6ace6c60b7a63ef","","26b56c1bdfb048c3e46419fde332bab76deb2cd3","")> Refresh </button>
<button value="Select" onclick=IDU("pok","0c25d1a648a3363fe30cad4541eac805b4cae5fd",$("input[name=what]:checked").val(),"81448fe273247b533b9f018e96c158cab7901247",$("input[name=value]:text").val())> SELECT </button>
  <input type="text"  name="value"><p>
  <input type="radio" name="what" value="meno"> ' . $GLOBALS['name'] . '
  <input type="radio" name="what" value="priezvisko"> ' . $GLOBALS['surname'] . '
  <input type="radio" name="what" value="login"> ' . $GLOBALS['login'] . '
  <input type="radio" name="what" value="prava"> ' . $GLOBALS['rights'] . '</p>
</div>
<p id="pok"> </p>
';

?>
</body>
</html>