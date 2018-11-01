<?php
    /**
     * Klasa PageModel implementuje ModelInterface i koristi se za prikaz i manipulaciju
     * nad podacima koji se nalaze u tabeli page.
     */
    class PageModel implements ModelInterface{
        /**
         * Funkcija getAll vraca sve stranice koje se nalaze u page tabeli.
         * @return void
         */
        public static function getAll(){
            $SQL = 'SELECT * FROM page ORDER BY seo_url;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute();
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        /**
         *  Funkcija getById vraca onu stranicu koja odgovara parametru page_id
         * @param int $page_id
         * @return object
         */
        public static function getById($page_id){
            $page_id = intval($page_id);
            $SQL = 'SELECT * FROM page WHERE page_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$page_id]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        /**
         * Funkcija vraca onu stranicu koja odgovara parametru seo_url
         * @param string $seo_url
         * @return object
         */
        public static function getBySeoUrl($seo_url){
            $SQL = 'SELECT * FROM page WHERE seo_url = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$seo_url]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
    }
