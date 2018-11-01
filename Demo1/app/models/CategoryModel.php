<?php
    /**
     * Klasa CategoryModel implementuje ModelInterface i koristi se za manipulaciju
     * nad podacima koji se nalaze u tabeli category.
     */
    class CategoryModel implements ModelInterface {
        /**
         * Funkcija getAll modela za rad sa kategorijama uzima sve kategorije
         * iz tabele.
         * @return array
         */
        public static function getAll(){
            $SQL = 'SELECT * FROM category ORDER BY name;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute();
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getById vraca jednu kategoriju iz baze podataka, prema parametru
         * category_id.
         * @param int $category_id
         * @return object
         */
        public static function getById($category_id){
            $category_id = intval($category_id);
            $SQL = 'SELECT * FROM category WHERE category_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$category_id]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija getByUserId preko spoljnog kljuca u tabeli category (user_id) 
         * uzima sve kategorije koje pripadaju korisniku koji ih je napravio/la.
         * @param int $user_id
         * @return object
         */
        public static function getByUserId($user_id){
            $user_id = intval($user_id);
            $SQL = 'SELECT * FROM category WHERE user_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$user_id]);
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija editById pravi izmene nad prethodno napravljenim kategorijama
         * ako su podaci tacno uneti u HTTP POST metodu.
         * @param int $id
         * @param string $name
         * @return void
         */
        public static function editById($id, $name) {
            $id = intval($id);
            $SQL = 'UPDATE category SET name = ? WHERE category_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$name, $id]);
        }
        /**
         * Funkcija add obavlja unos nove kategorije u tabelu ako su podaci tacno uneti u HTTP POST metodu.
         * @param string $name
         * @param string $type
         * @param int $user_id
         * @return boolean
         */
        public static function add($name, $type, $user_id) {
            $SQL = 'INSERT INTO category (`name`, `type`, `user_id`) VALUES (?, ?, ?);';
            $prep= Database::getInstance()->prepare($SQL);
            $res = $prep->execute([$name, $type, $user_id]);
            if ($res){
                return Database::getInstance()->lastInsertId();
            } else {
                return $res;
            }
        }
        /**
         * Funkcija deleteobavlja brisanje iz baze podataka.
         * @param int $category_id
         * @return void
         */
        public static function delete($category_id){
            $category_id = intval($category_id);
            $SQL = 'DELETE FROM category WHERE category_id=?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$category_id]);
        }
        
        /**
         * Funkcija getCategoryEntries uzima sve novcane unose koji pripadaju jednoj
         * kategoriji. Funkcija poziva veznu tabelu cash_category_cash i iz nje uzima
         * sve unose koji pripadaju toj funkciji i zatim pomocu OverviewModel-a
         * izlistava sve unose koji odgovaraju prethodno dobijenim cash_id.
         * @param int $category_id
         * @return array
         */
        public static function getCategoryEntries($category_id){
            $category_id = intval($category_id);
            $SQL = 'SELECT * FROM cash_category_cash WHERE category_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$category_id]);
            $items =  $prep->fetchAll(PDO::FETCH_OBJ);
            $list = [];
            foreach ($items as $item){
                $list[] = OverviewModel::getById($item->cash_id);
            }
            return $list;
        }
        /**
         * Funkcija addCash koristi se kada korisnik zeli da doda novi unos ili
         * izmeni postojece tako sto unosu dodeljuje kategoriju.
         * @param int $cash_id
         * @param int $category_id
         * @return void
         */
        public static function addCash($cash_id, $category_id){
            $SQL = 'INSERT IGNORE INTO cash_category_cash (cash_id, category_id) VALUES (?, ?);';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$cash_id, $category_id]);
        }
        /**
         * Funkcija vrsi pretragu unutar tabele category za sve kategorije kojima
         * odgovara parametar slug.
         * @param string $slug
         * @return array
         */
        public static function getCategoryBySlug($slug){
            $SQL = 'SELECT * FROM category WHERE `slug` = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$slug]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija vrsi pretragu unutar tabele category za sve kategorije kojima
         * odgovara parametar type.
         * @param string $type
         * @param string $user_id
         * @return array
         */
        public static function getCategoryByType($type, $user_id){
            $SQL = 'SELECT * FROM category WHERE `type` = ? and `user_id` = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$type, $user_id]);
            $items =  $prep->fetchAll(PDO::FETCH_OBJ);
            $list = [];
            foreach ($items as $item){
                $list[] = CategoryModel::getById($item->category_id);
            }
            return $list;
        }
        /**
         * Funkcija se koristi kada korisnik zeli da izbrise unos ili kategoriju,
         * tako sto prvobitno brise unose ili kategorije iz vezne tabele cash_category_cash.
         * @param int $category_id
         * @return void
         */
        public static function deleteCategoriesFromCCC($category_id){
            $category_id = intval($category_id);
            $SQL = 'DELETE FROM cash_category_cash WHERE category_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$category_id]);
        }
        
        
}
