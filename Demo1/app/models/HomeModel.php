<?php
    /**
     * Klasa HOmeModel implementuje ModelInterface i koristi se za manipulaciju
     * podacima koji se nalaze u tabeli user, njihov unos, citanje i brisanje.
     */
    class HomeModel implements ModelInterface{
        /**
         * Funkcija getAll vraca administratoru sve korisnike registrovane na
         * Veb aplikaciju.
         * @return array
         */
        public static function getAll(){
            $SQL = 'SELECT * FROM user ORDER BY user_id;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute();
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getById vraca administratoru jedan unos u tabelu user koji
         * sadrzi parametar user_id.
         * @param int $user_id
         * @return object
         */
        public static function getById($user_id){
            $user_id = intval($user_id);
            $SQL = 'SELECT * FROM user WHERE user_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$user_id]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija editById se poziva kada administrator ili korisnik zele da naprave izmene
         * u podacima unutar tabele ako su podaci tacno uneti u HTTP POST metodu.
         * @param int $user_id
         * @param string $username
         * @param text $fullname
         * @param email $email
         * @return void
         */
        public static function editById($user_id, $username, $lastname, $email) {
            $user_id = intval($user_id);
            $SQL = 'UPDATE user SET username = ?, fullname = ?, email = ? WHERE user_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$username, $lastname, $email, $user_id]);
        }
        /**
         * Funkcija delete poziva se kada administrator zeli da izbrise korisnicki
         * nalog sa Veb aplikacije.
         * @param int $user_id
         * @return void
         */
        public static function delete($user_id){
            $user_id = intval($user_id);
            $SQL = 'DELETE FROM user WHERE user_id=?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$user_id]);
        }
        /**
         * Funkcija add koristi se kada posetilac ili administrator zele da naprave
         * novi korisnicki nalog  ako su podaci tacno uneti u HTTP POST metodu.
         * @param string $username
         * @param text $fullname
         * @param type $email
         * @return type
         */
        public static function add($username, $passwordHash, $fullname, $email) {
            $SQL = 'INSERT INTO user (`username`, `password`, `fullname`, `email`) VALUES (?, ?, ?, ?);';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$username, $passwordHash, $fullname, $email]);
        }
    }
