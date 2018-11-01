<?php
    /**
     * Klasa ContactModel implementuje ModelInterface i koristi se za manipulaciju
     * nad podacima u tabeli contact, njihov unos i citanje.
     */
    class ContactModel implements ModelInterface {
        /**
         * Funkcija getAll izlistava sve poruke koje su korisnici ili posetioci ostavili
         * administratoru Veb aplikacije.
         * @return void
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM message ORDER BY name;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute();
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getById vraca jednu ostavljenu poruku preko parametra message_id
         * @param int $message_id
         * @return type
         */
        public static function getById($message_id) {
            $message_id = intval($message_id);
            $SQL = 'SELECT * FROM message WHERE message_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$message_id]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija insert koristi se kada korisnik ili posetilac zeli da ostavi
         * poruku administratoru ako su podaci tacno uneti u HTTP POST metodu.
         * @param email $email
         * @param text $subject
         * @param text $text
         * @return void
         */
        public static function insert($email, $subject, $text){
            $SQL= 'INSERT INTO message(datetime, email, subject, `text`) VALUES (NOW(), ?, ?, ?);';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$email, $subject, $text]);
        }
    }
