<?php
    class UserLoginModel implements ModelInterface {
        
        public static function getAll(){
            $SQL = 'SELECT * FROM user_login ORDER BY `datetime` DESC;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute();
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        
        public static function getById($user_login_id){
            $user_login_id = intval($user_login_id);
            $SQL = 'SELECT * FROM user_login WHERE user_login_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$user_login_id]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        
        public static function getByUserId($user_od){
            $user_od = intval($user_od);
            $SQL = 'SELECT * FROM user_login WHERE user_od = ? ORDER BY `datetime` DESC;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$user_od]);
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }

}
