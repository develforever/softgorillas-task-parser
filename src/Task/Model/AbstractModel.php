<?php

namespace App\Task\Model;


/*
Pola bytu “przegląd”:
● opis
● typ (przegląd)
● data przeglądu (Y-m-d)
● tydzień w roku daty przeglądu
● status
● zalecenia dalszej obsługi po przeglądzie
● numer telefonu osoby do kontaktu po stronie klienta
● data utworzenia
Pola bytu “zgłoszenie awarii”:
● opis
● typ (zgłoszenie awarii)
● priorytet
● termin wizyty serwisu (Y-m-d)
● status
● uwagi serwisu
● numer telefonu osoby do kontaktu po stronie klienta
● data utworzenia
*/

abstract class AbstractModel {

    public $description;
    public $type;
    public $status;
    public $phone;
    public $creationDate;
    public $priority;
    public $notes;
}