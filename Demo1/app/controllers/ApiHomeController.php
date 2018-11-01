<?php
    /**
     * Klasa ApiHomeController koristi se u slucajevima kada korisnik zeli da posebna aplikacija preuzme kontrolu umesto standardnih kontrolera.
     */
    class ApiHomeController extends ApiController{
        /**
         * Metod show aplikacionog kontrolera prikazuje sve kategorije kojima jedan unos pripada
         * @param int $id
         */
        public function show($id){
            $cash_id = intval($id);
            $cashbook = OverviewModel::getById($cash_id);
            
            if ( $cashbook ) {
                $cashbook->categories = OverviewModel::getCashCategories($cash_id);
                $this->setData('cash', $cashbook);
                $this->setData('status', 'success');
            } else {
                $this->setData('status', 'error');
                $this->setData('message', 'Ne možemo pronaći traženi unos.');
            }
        }
        /**
         * Metod categories aplikacionog kontrolera prikazuje sve kategorije.
         */
        public function categories(){
            $categories = CategoryModel::getAll();
            if ( $categories ) {
                $this->setData('categories', $categories);
                $this->setData('status', 'success');
            } else {
                $this->setData('status', 'error');
                $this->setData('message', 'Ne možemo pronaći tražene kategorije.');
            }
        }
        /**
         * Metod category aplikacionog kontrolera prikazuje sve unose za jednu kategoriju preko parametra $id.
         * @param int $id
         */
        public function category($id){
            $category_id = intval($id);
            $cashbook = CategoryModel::getCategoryEntries($category_id);
            
            if ( $cashbook ) {
                $this->setData('cash', $cashbook);
                $this->setData('status', 'success');
            } else {
                $this->setData('status', 'error');
                $this->setData('message', 'Ne možemo pronaći unos za traženu kategoriju.');
            }
        }
        /**
         * Metod search aplikacionog kontrolera koristi se za pretragu unutar liste unosa preko kljucne reci.
         * @param string $keyword
         */
        public function search($keyword){
            $cashbook = OverviewModel::getByKeyword($keyword);
            
            if ( $cashbook ) {
                $this->setData('cash', $cashbook);
                $this->setData('status', 'success');
            } else {
                $this->setData('status', 'error');
                $this->setData('message', 'Ne postoje takvi unosi u bazi podataka.');
            }
        }
        /*
         * Metod add aplikacionog kontrolera koristi se za dodavanje novih unosa ako su podaci tacno uneti u HTTP POST metodu.
         */
        public function add(){
            if ($_POST) {
                $name        = filter_input(INPUT_POST, 'name');
                $description = filter_input(INPUT_POST, 'description');
                $value       = floatval(filter_input(INPUT_POST, 'value'));
                
                $categories  = filter_input(INPUT_POST, 'categories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                
                $id = OverviewModel::add($name, $description, $value, 1); //simulacija da je dodao korisnik sa user_id 1, jer nemam sistem koji mi pokazuje koji je korisnik aktivan
                
                if (!$id){
                    $this->setData('status', 'error');
                    $this->setData('message', 'Došlo je do greške prilikom unosa u bazu podataka.');
                    return;
                }
                
                foreach ($categories as $category){
                    CategoryModel::addCash($id, $category);
                }
                
                $this->setData('cash_id', $id);
                $this->setData('status', 'success');
            } else {
                
                $this->setData('status', 'error');
                $this->setData('message', 'Greška.');
            }
        }
    }
