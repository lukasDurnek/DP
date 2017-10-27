<?php
function updateNonExistingMail(PDO $connection, $email)
{
    $sql = $connection->query("Select id from mail where mail='$email'")->fetchAll();
    var_dump($email);
    var_dump($sql);
    if(count($sql) > 0 ){

        $sql = $connection->query("UPDATE mail SET  vymazany='true' where mail='$email'");
        $sql = $connection->query("UPDATE mail SET poznamka = 'automat', delete_time = CURRENT_TIMESTAMP  where mail = '$email' ");

        $sql = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas,poznamka) values('mail','$email','vymazany','false','true',CURRENT_TIMESTAMP,'update - automat')");
        var_dump($sql);

        exit;
    }
}

function updateSpam(PDO $connection, $email2)
{
    $sql = $connection->query("Select id from mail where mail='$email2'")->fetchAll();
    var_dump($email2);
    echo $sql;
    var_dump($sql);
    if(count($sql) > 0 ){

        $sql = $connection->query("UPDATE mail SET spam = '100' where mail='$email2'");

        $sql = $connection->query("insert into zmena(tabulka, kluc, stlpec, stara_hodnota, nova_hodnota, cas) values('mail','$email2','spam','0','100',CURRENT_TIMESTAMP)");
        var_dump($sql);

        exit;
    }
}



?>