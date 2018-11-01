<?php
    class TagModel implements ModelInterface {
        public static function getAll(){
            $SQL = 'SELECT * FROM tag ORDER BY name;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute();
            return $prep->fetchAll(PDO::FETCH_OBJ);
        }
        
        public static function getById($id){
            $id = intval($id);
            $SQL = 'SELECT * FROM tag WHERE tag_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            $prep->execute([$id]);
            return $prep->fetch(PDO::FETCH_OBJ);
        }
        
        public static function add($name, $classes) {
            $SQL = 'INSERT INTO tag (`name`, `image_class`) VALUES (?, ?);';
            $prep= Database::getInstance()->prepare($SQL);
            $res = $prep->execute([$name, $classes]);
            if ($res){
                return Database::getInstance()->lastInsertId();
            } else {
                return $res;
            }
        }
        
        public static function editById($id, $name, $classes) {
            $id = intval($id);
            $SQL = 'UPDATE tag SET `name` = ?, `image_class` = ? WHERE tag_id = ?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$name, $classes, $id]);
        }
        
        public static function delete($tag_id){
            $tag_id = intval($tag_id);
            $SQL = 'DELETE FROM tag WHERE tag_id=?;';
            $prep= Database::getInstance()->prepare($SQL);
            return $prep->execute([$tag_id]);
        }
    }
