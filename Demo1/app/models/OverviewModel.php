<?php
    /**
     * Klasa OverviewModel implementuje ModelInterface i koristi se za manipulaciju
     * podacima smestenim u tabelu cash, njihovo citanje, izmene, unos i brisanje
     * ako su podaci tacno uneti u HTTP POST metodu.
     */
    class OverviewModel implements ModelInterface{
        /**
         * Funkcija getAll vraca administratoru sve unose napravljene u Veb
         * aplikaciji, poredjane po cash_id.
         * @return array
         */
        public static function getAll(){
            $SQL = 'SELECT * FROM cash ORDER BY cash_id;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute();
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getById vraca jedan unos, koji odgovara parametru cash_id.
         * @param int $cash_id
         * @return object
         */
        public static function getById($cash_id){
            $cash_id = intval($cash_id);
            $SQL = 'SELECT * FROM cash WHERE cash_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$cash_id]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getByUserId vraca sve unose koje je napravio korisnik koji
         * odgovara parametru user_id. Funkcija sortira po vremenu unosa.
         * @param int $user_id
         * @return array
         */
        public static function getByUserId($user_id){
            $user_id = intval($user_id);
            $SQL = 'SELECT * FROM cash WHERE user_id = ? ORDER BY created_at DESC;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$user_id]);
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getByUserIdAndValue vraca sve unose koje je jedan korisnik napravio sortirane
         * po vrednosti
         * @param int $user_id
         * @return array
         */
        public static function getByUserIdAndValue($user_id){
            $user_id = intval($user_id);
            $SQL = 'SELECT * FROM cash WHERE user_id = ? ORDER BY value DESC;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$user_id]);
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getByKeyword vraca sve unose koji odgovaraju kljucnoj reci, nezavisno od
         * toga da li se kljucna rec nalazi u imenu ili opisu unosa.
         * @param string $keyword
         * @return array
         */
        public static function getByKeyword($keyword){
            $SQL = 'SELECT * FROM cash WHERE name LIKE ? OR description LIKE ? ORDER BY cash_id;';
            $prep= Database::getInstance()->prepare($SQL);
            $string = '%' . trim($keyword) . '%';
            $prep->execute([$string, $string]);
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija editById koristi se kada korisnik zeli da izmeni jedan od
         * svojih unosa ako su podaci tacno uneti u HTTP POST metodu.
         * @param int $cash_id
         * @param string $name
         * @param text $description
         * @param double $value
         * @return void
         */
        public static function editById($cash_id, $name, $description, $value) {
            $cash_id = intval($cash_id);
            $SQL = 'UPDATE cash SET name = ?, description = ?, value = ? WHERE cash_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$name, $description, $value, $cash_id]);
        }
        /**
         * Funkcija delete koristi se kada korisnik zeli da izbrise jedan od unosa.
         * @param int $cash_id
         * @return void
         */
        public static function delete($cash_id){
            $cash_id = intval($cash_id);
            $SQL = 'DELETE FROM cash WHERE cash_id=?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$cash_id]);
        }
        /**
         * Funkcija add koristi se kada korisnik zeli da napravi novi unos na
         * svoj racun ako su podaci tacno uneti u HTTP POST metodu.
         * editById
         * @param string $name
         * @param text $description
         * @param double $value
         * @param int $user_id
         * @return boolean
         */
        public static function add($name, $description, $value, $user_id) {
            $SQL = 'INSERT INTO cash (`name`, `description`, `value`, `user_id`) VALUES (?, ?, ?, ?);';
            $prep= Database::getInstance()->prepare($SQL);
            $res = $prep->execute([$name, $description, $value, $user_id]);
            if ($res){
                return Database::getInstance()->lastInsertId();
            } else {
                return $res;
            }
        }
        
        /**
         * Funkcija getCashCategories vraca sve kategorije kojima jedan unos pripada,
         * koristeci parametar cash_id.
         * @param int $cash_id
         * @return array
         */
        public static function getCashCategories($cash_id){
            $cash_id = intval($cash_id);
            $SQL = 'SELECT * FROM cash_category_cash WHERE cash_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$cash_id]);
            $items =  $prep->fetchAll(PDO::FETCH_OBJ);
            $list = [];
            foreach ($items as $item){
                $list[] = CategoryModel::getById($item->category_id);
            }
            return $list;
        }
        /**
         * Funkcija se koristi kada korisnik zeli da izbrise jedan od svojih
         * unosa. Funkcija prvo brise taj unos i sve veze sa kategorijama iz
         * vezne tabele cash_category_cash, a zatim je korisniku omoguceno da
         * pomocu delete funkcije izbrise unos i iz cash tabele.
         * @param int $cash_id
         * @return void
         */
        public static function deleteFromCCC($cash_id){
            $cash_id = intval($cash_id);
            $SQL = 'DELETE FROM cash_category_cash WHERE cash_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$cash_id]);
        }
        /**
         * Funkcija vraca niz svih vrednosti koje su napravljene u jednom mesecu.
         * @param int $cash_id
         * @param timestamp $date
         * @return array
         */
        public static function getValueByMonth($cash_id, $date){
            $SQL = 'SELECT * FROM cash WHERE cash_id = ? AND created_at LIKE ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$cash_id, $date]);
            $items =  $prep->fetchAll(PDO::FETCH_OBJ);
            $list = [];
            foreach ($items as $item){
                $list[] = OverviewModel::getById($item->cash_id);
            }
            return $list;
        }
    }
