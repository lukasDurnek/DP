function POKUS() {
    window.alert("sadasdasda");
}

function IDU(id, table, text, action, idintable) {
    // id objektu,tabulky v php...
    // table je tabulka v DB
    // text je to co budem vkladat
    // action akcia ktora sa vykona
    console.log(arguments);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(id).innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "idu.php?table=" + table + "&text=" + text + "&action=" + action + "&idintable=" + idintable, true);
    xmlhttp.send();
}

function newmail(id, kontaktid) {
    document.getElementById(id).innerHTML = "<input type='text' id='myText'><img alt='ok' src='./images/ok.png' onclick=\"IDU('pok', 'mail', document.getElementById('myText').value, 'add', " + kontaktid + ")\" style='width:20px;'/>";
}

function pridajskupinu(id, mailid) {
    document.getElementById(id).innerHTML = "<input type='text' id='myText'><img alt='ok' src='images/ok.png' onclick=\"IDU('pok', 'b10fb50537d357e0bcd28b904d46afa4b7a695d6', document.getElementById('myText').value, 'add', '" + mailid + "')\" style='width:20px;'/>";
}

function toggle(source) {
    checkboxes = document.getElementsByName('foo');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

function checkFormR(form,sprava) {
    var re = /^[\w ]+$/;
    var emailcheck = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (!emailcheck.test(form.email.value)) {
        alert(sprava);
        return false;
    }
}