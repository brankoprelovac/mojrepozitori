<?php
    /*
     * Klasa BallanceModel implementuje ModelInteface.
     */
    class BallanceModel implements ModelInterface{
        //put your code here
        public static function getAll() {
        
    }

    public static function getById($id) {
        
    }

    public static function getAllByUserAndDateRange($user_id, $dateFrom, $dateTo) {
        $sql = "SELECT
                        U.godina_mesec,
                        MAX(U.suma_prihoda_za_mesec) AS prihodi,
                        MAX(U.suma_rashoda_za_mesec) AS rashodi,
                        MAX(U.suma_prihoda_za_mesec) - MAX(U.suma_rashoda_za_mesec) AS balans
                FROM (
                        SELECT
                                SUBSTRING(DATE(cash.created_at), 1, 7) godina_mesec,
                                SUM(cash.value) suma_prihoda_za_mesec,
                                NULL suma_rashoda_za_mesec
                        FROM
                                cash
                                INNER JOIN cash_category_cash ON cash_category_cash.cash_id = cash.cash_id
                                INNER JOIN category ON category.category_id = cash_category_cash.category_id
                        WHERE
                                category.type = 'prihodi'
                                AND category.user_id = ?
                                AND DATE(created_at) BETWEEN ? AND ?
                        GROUP BY
                                SUBSTRING(DATE(cash.created_at), 1, 7)

                        UNION

                        SELECT
                                SUBSTRING(DATE(cash.created_at), 1, 7) godina_mesec,
                                NULL suma_prihoda_za_mesec,
                                SUM(cash.value) suma_rashoda_za_mesec
                        FROM
                                cash
                                INNER JOIN cash_category_cash ON cash_category_cash.cash_id = cash.cash_id
                                INNER JOIN category ON category.category_id = cash_category_cash.category_id
                        WHERE
                                category.type = 'rashodi'
                                AND category.user_id = ?
                                AND DATE(created_at) BETWEEN ? AND ?
                        GROUP BY
                                SUBSTRING(DATE(cash.created_at), 1, 7)
                ) AS U
                GROUP BY
                        U.godina_mesec;";
        $prep = Database::getInstance()->prepare($sql);
        $res = $prep->execute([$user_id, $dateFrom, $dateTo, $user_id, $dateFrom, $dateTo]);
        if (!$res) {
            return [];
        }
        
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
    
    public static function getPositiveEntries($user_id){
            $sql = "
                SELECT
                    cash.name,
                    cash.value
                FROM
                    cash
                    INNER JOIN cash_category_cash ON cash_category_cash.cash_id = cash.cash_id
                    INNER JOIN category ON category.category_id = cash_category_cash.category_id
                WHERE
                    category.type = 'prihodi'
                    and category.user_id = ?;";
            $prep = Database::getInstance()->prepare($sql);
            $res = $prep->execute([$user_id]);
            if (!$res) {
                return [];
            }
        
            return $prep->fetchAll(PDO::FETCH_OBJ);
            
    }
    
    public static function getNegativeEntries($user_id){
            $sql = "
                SELECT
                    cash.name,
                    cash.value
                FROM
                    cash
                    INNER JOIN cash_category_cash ON cash_category_cash.cash_id = cash.cash_id
                    INNER JOIN category ON category.category_id = cash_category_cash.category_id
                WHERE
                    category.type = 'rashodi'
                    and category.user_id = ?;";
            $prep = Database::getInstance()->prepare($sql);
            $res = $prep->execute([$user_id]);
            if (!$res) {
                return [];
            }
        
            return $prep->fetchAll(PDO::FETCH_OBJ);
            
    }

}
