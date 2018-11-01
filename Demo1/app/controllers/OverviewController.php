<?php
    /**
     * Klasa OverviewController odgovara tabeli cash u bazi podataka i koristi
     * se za rad sa unosima novcanog stanja na racun korisnika.
     */
    class OverviewController extends AdminController {
        /**
         * Metod indeks kontrolera za novac prikazuje spisak unosa sa kategorijama
         * i opcijama za dodavanje novih unosa, izmenu i brisanje postojecih unosa.
         */
        public function index(){
            $this->setData('seo_title', 'Spisak unosa novca na stanje | Aplikacija za vođenje ličnih finansija');
            
            
          $cashbook = OverviewModel::getByUserId(Session::get('user_id'));
          for ($i = 0; $i<count($cashbook); $i++){
              $cashbook[$i]->categories = OverviewModel::getCashCategories($cashbook[$i]->cash_id);
          }
          $this->setData('cash', $cashbook);
        }
        /**
         * Metod indeks kontrolera za novac prikazuje spisak unosa sa kategorijama
         * i opcijama za dodavanje novih unosa, izmenu i brisanje postojecih unosa.
         */
        public function orderByValue(){
            $this->setData('seo_title', 'Spisak unosa novca poređanih po vrednosti| Aplikacija za vodjenje licnih finansija');
            
            
          $cashbook = OverviewModel::getByUserIdAndValue(Session::get('user_id'));
          for ($i = 0; $i<count($cashbook); $i++){
              $cashbook[$i]->categories = OverviewModel::getCashCategories($cashbook[$i]->cash_id);
          }
          $this->setData('cash', $cashbook);
        }
        /**
         * Metod edit kontrolera za rad sa novcem koristi se kada korisnik zeli
         * da izmeni u prethodno napravljene unose ako su podaci tacno uneti u HTTP POST metodu.
         * @param int $cash_id
         */
        public function edit($cash_id) {
             $this->setData('seo_title', 'Izmenite unos!');
            
            $cash = OverviewModel::getById($cash_id);
            if ($cash->user_id != Session::get('user_id')) {
                Misc::redirect('overview');
            }
            
            if ($_POST){
                #izmena vrednosti
                #redirekcija na listu
                
                $name        = filter_input(INPUT_POST, 'name');
                $description = filter_input(INPUT_POST, 'description');
                $value       = floatval(filter_input(INPUT_POST, 'value'));
                
                $category  = filter_input(INPUT_POST, 'categories');
                
                if (!preg_match('/[A-z 0-9\-]+/', $name) or !preg_match('/[A-z 0-9\-]+/', $description) or $value == 0) {
                    $this->setData('message', 'Izmene nisu tačno unete.');
                } else {
                    $clear = OverviewModel::deleteFromCCC($cash_id);
                    
                    $res = OverviewModel::editById($cash_id, $name, $description, $value);
                    if ($res){
                            $cid= CategoryModel::getById($category);
                            if ($cid->user_id == Session::get('user_id')){
                            CategoryModel::addCash($cash_id, $category);
                            Misc::redirect('overview');
                            } else {
                                $this->setData('message', 'Niste vlasnik kategorije.');
                            }
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom izmene.');
                    }
                }
                
            }
            
            $cash = OverviewModel::getById($cash_id);
            $this->setData('cash', $cash);
            $categories = CategoryModel::getByUserId(Session::get('user_id'));
            $this->setData('categories', $categories);
        }
        /**
         * Metod delete kontrolera za rad sa novcem koristi se kada korisnik
         * zeli da izbrise prethodno napravljen unos.
         * @param int $cash_id
         */
        public function delete($cash_id) {
             $this->setData('seo_title', 'Izbrišite unos!');
            
            $cash = OverviewModel::getById($cash_id);
            if ($cash->user_id != Session::get('user_id')) {
                Misc::redirect('overview');
            }
            
            if ($_POST){
                #brisanje vrednosti
                #redirekcija na listu
                
                $confirmed = filter_input(INPUT_POST, 'confirmed', FILTER_SANITIZE_NUMBER_INT);
                
                if ($confirmed == 1 and $cash->user_id == Session::get('user_id')){
                    $res2= OverviewModel::deleteFromCCC($cash_id);
                    $res = OverviewModel::delete($cash_id);
                    if ($res2){
                        if ($res){
                        Misc::redirect('overview');
                        }
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom brisanja unosa.');
                    }
                }
            }
            
            $cash = OverviewModel::getById($cash_id);
            $this->setData('cash', $cash);
        }
        /**
         * Metod add kontrolera za rad sa novcem koristi se kada korisnik zeli
         * da napravi novi unos na svoj racun ako su podaci tacno uneti u HTTP POST metodu.
         */
        public function add() {
             $this->setData('seo_title', 'Dodajte unos!');
            if ($_POST){
                #dodavanje vrednosti
                #redirekcija na listu
                
                $name = filter_input(INPUT_POST, 'name');
                $description = filter_input(INPUT_POST, 'description');
                $value = floatval(filter_input(INPUT_POST, 'value'));
                
                $category  = filter_input(INPUT_POST, 'categories');
                
                if (!preg_match('/[A-z 0-9\-]+/', $name) or !preg_match('/[A-z 0-9\-]+/', $description) or $value == 0) {
                    $this->setData('message', 'Podaci nisu tačno uneti.');
                } else {
                    $id = OverviewModel::add($name, $description, $value, Session::get('user_id'));
                    if ($id){
                            $cid = CategoryModel::getById($category);
                            if ($cid->user_id == Session::get('user_id')){
                                CategoryModel::addCash($id, $category);
                            } else {
                                $this->setData('message', 'Niste vlasnik kategorije');
                            }
                        
                            Misc::redirect('overview');
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom dodavanja.');
                    }
                }    
            }
            $this->setData('categories', CategoryModel::getByUserId(Session::get('user_id')));
        }
    }