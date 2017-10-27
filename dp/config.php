<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = "sk";
}

$_SESSION['TableUzivatel'] = 'Uzivatel';
$_SESSION['TablePrihlasenie'] = 'Prihlasenie';

$_SESSION['TableKontakt'] = 'Kontakt';
$_SESSION['TableMail'] = 'Mail';
$_SESSION['TableSkupina'] = 'Skupina';
$_SESSION['TableMail_spec'] = 'Mail_spec';

$title = 'Mail';
$mail = 'e-mail';
$login = 'login';

if ($_SESSION['language'] == 'sk') {

    //ENGINE
    $users = 'Používatelia';
    $name = 'meno';
    $password = 'heslo';
    $log_in = 'prihlásiť';
    $log_out = 'neprihlásený';
    $cancel = 'odhlásiť';
    $groups = 'Skupiny';
    $group = 'skupina';
    $header = 'hlavička';
    $textmail = 'text e-mailu';
    $address = 'adresa';
    $run = 'spust';
    $send = 'odošli';
    $language = 'jazyk';
    $config = 'Zmena e-mailu';
    $after_sending='Po poslaní daného počtu e-mailov: ';
    $wait=' čakať: ';
    $seconds=' sekúnd';

    //contacs
    $contacts = 'Kontakty';
    $title_before = 'titul pred';
    $fname = 'meno';
    $surname = 'priezvisko';
    $title_for = 'tituly za';
    $to_send = 'posielať';
    $add = 'pridaj';
    $remove = 'odstráň';
    $mail_example = 'email@priklad.sk';
    $new_contact = 'Nový kontakt';
    $new_user = 'Nový používateľ';
    $contact_add = 'Kontakt bol pridaný';
    $mail_add = 'e-mail pridaný';
    $user_add = 'užívateľ úspešne pridaný';
    $mail_delete = 'e-mail odstranený';
    $mails_to_group = 'vybrané e-maily zo skupiny:';
    $removed = 'vymazaný';
    $choice = 'Vyber';
    $duplication = 'duplicita';
    $original = 'pôvodné';
    $replace = 'vymeň';
    $new = 'nový';
    $hide_show = 'Skry/Ukáž vymazaných';
    $administration_group = 'Administrácia skupín';
    $arrangement = 'zaradenie';
    $group_deleted = 'skupina vymazaná';
    $server = 'server';
    $server_name = 'gmail';
    $upload_file = 'Vybrať súbor';
    $upload = 'pripoj';
    $remove_attachment = 'odstráň prílohy';
    $attach_files = 'Prílohy: ';
    $searching_adr = 'Vyhľadané adresy';
    $del_time  = "čas zmazania";
    $note = "poznámka";

    //users
    $rights = 'práva';
    $user_was_added = 'Užívateľ bol pridaný';
    $from = 'od';
    $to = 'do';
    $mail_spec_delete = 'e-mail úspešne odstránený';
    $user_delete = 'užívateľ vymazaný';
    $change = "Zmena vykonaná";
    $mail_id = 'id e-mailu';
    $group_id = 'id skupiny';
    $group_name = 'názov skupiny';
    $create = 'vytvor novú';
    $group_added = 'skupina úspešne vytvorená';
    $join = 'spoj';
    $like_copy = 'ako kópiu:';
    $warning = 'Upozornenia';
    $key = 'klúč';
    $value = 'hodnota';
    $reason = 'dôvod';
    $operation = 'operácia';
    $possibility_remove = 'Pripojiť odkaz na zmazanie';

    //zber adries
    $mail_deleted = "Email vymazaný";
    $collection_of_addresses = "Zber adries";
    $mail_addresses = "E-mailové adresy";
    $analyzed_mails = "Analýza e-mailov";
    $show = "Ukáž";
    $typeMails = "Vyber typ emailových adries";
    $unexistingMails = "Neexistujúce";
    $spam = "Nevyžiadana pošta";
    $level = "úroveň";
    $source = "zdroj";
    $searching_web = "Získanie URL";
    $field = "oblasť";
    $domain = "doména";
    $browsing_web = "Prehľadávanie webu";

    //errors
    $time_consuming = 'táto akcia je časovo náročná';
    $existing_mail = 'ERROR: Zadaný e-mail existuje';
    $existing_login = 'ERROR: Existujúci login';
    $unregistered = 'ERROR: neregistrovaný';
    $format_mail = 'ERROR: zle zadaný formát e-mailu';
    $wrong_mail_password = 'ERROR: Zle zadaný e-mail/heslo';
    $unlisted_field = 'ERROR: nevyplnené pole';
    $mismatched_passwords = 'ERROR: heslá sa nezhodujú';
    $existing_group = 'ERROR: zadaná skupina existuje';
    $failed_group = "ERROR: zadaná skupina NEexistuje";

    $number_of_duplicates = "ERROR: počet duplicitných emailov: ";
    $number_of_adds = "Počet pridaných";

}
if ($_SESSION['language'] == 'en') {

    //ENGINE
    $contacts = 'contacts';
    $users = 'users';
    $name = 'name';
    $password = 'password';
    $log_in = 'login';
    $log_out = 'unlogged';
    $cancel = 'Log out';
    $groups = 'groups';
    $group = 'group';
    $header = 'header';
    $textmail = 'mail text';
    $address = 'address';
    $send = 'send';
    $config = 'change e-mail';
    $after_sending='After send : ';
    $wait=' email, will wait: ';
    $seconds=' seconds';

    $title_before = 'degree before';
    $fname = 'fist name';
    $surname = 'last name';
    $title_for = 'degree after';
    $to_send = 'send';
    $add = 'add';
    $remove = 'remove';
    $mail_example = 'email@example.sk';
    $new_contact = 'new contact';
    $new_user = 'new user';
    $contact_add = 'Contact added';
    $mail_add = 'e-mail added';
    $user_add = 'user successfully added ';
    $mail_delete = 'e-mail deleted';
    $mails_to_group = 'chosen e-mails from group:';
    $removed = 'deleted';
    $choice = 'Select';
    $duplication = 'duplicity';
    $original = 'aborigine';
    $replace = 'change';
    $new = 'new';
    $hide_show = 'Show/Hide deleleted';
    $arrangement = 'arrangement';
    $group_name = 'group name';
    $server = 'server';
    $server_name = 'gmail';

    //contacts
    $contacts = 'contacts';
    $rights = 'rights';
    $user_was_added = 'User added';
    $from = 'from';
    $to = 'to';
    $mail_spec_delete = 'e-mail successfully deleted';
    $user_delete = 'user deleted';
    $language = 'language';
    $run = 'run';
    $change = "Changed";
    $mail_id = 'e-mail id';
    $group_id = 'group id';
    $administration_group = 'groups administration';
    $create = 'create new';
    $group_added = 'group successfully added';
    $group_deleted = 'group deleted';
    $join = 'connect';
    $like_copy = 'as copy:';
    $warning = 'warnings';
    $key = 'key';
    $value = 'value';
    $reason = 'reason';
    $operation = 'operation';
    $possibility_remove = 'Include delete link';
    $mail_deleted = "mail deleted";
    $upload_file = 'Select File';
    $upload = 'upload';
    $remove_attachment = 'remove attachment';
    $attach_files = 'attach files: ';
    $del_time = "delete time";
    $note = "remark";

    //collection mails
    $collection_of_addresses = "collection of addresses";
    $searching_adr = 'searching addresses';
    $mail_addresses = "email addresses";
    $analyzed_mails = "analyzed emails";
    $show = "show";
    $typeMails = "type of email addresses";
    $unexistingMails = "Unexisting emails";
    $spam = "Spam";
    $level = "level";
    $source = "source";
    $searching_web = "Searching web";
    $field = "field";
    $domain = "domain";
    $browsing_web = "Browsing web";

    //ERRORS
    $time_consuming = 'This action may need several minutes';
    $existing_mail = 'Existing e-mail';
    $format_mail = 'ERROR: misspelled e-mail format';
    $unregistered = 'unregistered';
    $wrong_mail_password = 'Wrong e-mail/password';
    $unlisted_field = 'unfilled required objects';
    $mismatched_passwords = 'passwords aren\'t identical';
    $existing_group = 'Existing group';
    $failed_group = 'Don\'t existing group';
    $number_of_duplicates = 'ERROR: number of duplicate emails: ';
    $number_of_adds = 'Number of adds: ';

}