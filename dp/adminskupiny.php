<?php
require('base.php');
$title = $GLOBALS['administration_group'];
$active = 6;
$table = '023d69ed795d2cfd4fa2db3f8f52b47599aa14ad';
$action = '755084a108fdfcd60abd95388cfcce04c1b80574';
generateBase();

echo '
<div class="center">

    <p><button value="Vytvor" onclick=IDU("pok","023d69ed795d2cfd4fa2db3f8f52b47599aa14ad",$("input[name=value3]:text").val(),"add",$("input[name=value]:text").val())> ' . $create . ' </button>
        <input type="text"  name="value" placeholder="' . $name . '" style="width:100px;">
        ' . $GLOBALS['like_copy'] . ' <input type="text"  name="value3" placeholder="' . $name . '" style="width:100px;"> </p>

    <p><button value="Spoj" onclick=IDU("pok","023d69ed795d2cfd4fa2db3f8f52b47599aa14ad",$("input[name=name1]:text").val(),"05425480ddceaa07bd073ebaac46cc71acaf70c3",$("input[name=name2]:text").val())> ' . $join . ' </button>
        ' . $GLOBALS['name'] . '1: <input type="text"  name="name1" placeholder="' . $GLOBALS['name'] . '" style="width:100px;">
        ' . $GLOBALS['name'] . '2: <input type="text"  name="name2" placeholder="' . $GLOBALS['name'] . '" style="width:100px;">

    <p><button value="Select" onclick=IDU("pok","023d69ed795d2cfd4fa2db3f8f52b47599aa14ad",$("input[name=what]:checked").val(),"81448fe273247b533b9f018e96c158cab7901247",$("input[name=value2]:text").val())> ' . $choice . ' </button>
        <input type="text"  name="value2">
        <input type="radio" name="what" value="name"> ' . $GLOBALS['name'] . '
        <input type="radio" name="what" value="id"> ' . $GLOBALS['group_id'] . '</p>

</div>
<p id="pok"> </p>';