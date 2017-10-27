<?php
require('base.php');
$title = $GLOBALS['searching_adr'];
$active = 11;
$table='coll_addr';
$action='755084a108fdfcd60abd95388cfcce04c1b80574';
generateBase();

echo '
<div class="center"><p>
<button value="REFRESH" onclick=IDU("pok","coll_addr","","26b56c1bdfb048c3e46419fde332bab76deb2cd3","")> Refresh </button>
<button value="Select" onclick=IDU("pok","coll_addr",$("input[name=what]:checked").val(),"81448fe273247b533b9f018e96c158cab7901247",$("input[name=value]:text").val())> ' . $choice . ' </button>
  <input type="text"  name="value">
  <input type="radio" name="what" value="meno"> ' . $GLOBALS['name'] . '
  <input type="radio" name="what" value="priezvisko"> ' . $GLOBALS['surname'] . '
  <input type="radio" name="what" value="mail"> ' . $GLOBALS['mail'] . '</p><p></p>
</div>

<p id="pok"> </p>
';
?>
</body>
</html>