<?php
    /**
     * Klasa CategoryController odgovara tabeli category u bazi podataka i koristi se za rad sa kategorijama.
     */
    class CategoryController extends AdminController {
        /**
         * Indeks metod kontrolera za rad sa kategorijama ispisuje sve kategorije koje je prijavljeni korisnik napravio/la.
         */
        public function index(){
            $this->setData('seo_title', 'Pregled po kategorijama | Aplikacija za vođenje ličnih finansija');
            
            $category = CategoryModel::getByUserId(Session::get('user_id'));
                for ($i = 0; $i<count($category); $i++){
                    $category[$i]->entries = CategoryModel::getCategoryEntries($category[$i]->category_id);
                }
            $this->setData('category', $category);
            
            
        }
        /**
         *  listByCategory metod kontrolera za rad sa kategorijama ispisuje sve unose za jednu kategoriju pomocu slug parametra.
         * @param string $categorySlug
         */
        public function listByCategory($categorySlug){
            $this->setData('seo_title', 'Prikaz unosa za odabranu kategoriju.');
            
            $category = CategoryModel::getCategoryBySlug($categorySlug);
            $this->setData('ime_kategorije', $category->name);
            
            if (!$category){
                Misc::redirect('categories');
                $this->setData('message', 'Ne postoje unosi za odabranu kategoriju.');
            } else {
                if ($category->user_id !== Session::get('user_id')) {
                    $this->setData('message', 'Nemate pristup.');
                    $this->setData('category', []);
                    return;
                }
                
                $entries = CategoryModel::getCategoryEntries($category->category_id);
                $this->setData('category', $entries);
            }
            
        }
        /**
         * Add metod kontrolera za rad sa kategorijama koristi se za pravljenje
         * nove kategorije ako su podaci tacno uneti u HTTP POST metodu.
         */
        public function add(){
            $this->setData('seo_title', 'Napravite novu kategoriju.');
            
            if($_POST){
                
                $name = filter_input(INPUT_POST, 'name');
                $type = filter_input(INPUT_POST, 'type'); 
                
                if(!preg_match('/[A-z 0-9\-]+/', $name)) {
                    $this->setData('message', 'Podaci nisu pravilno uneti.');
                } else if ($type == 'prihodi') {
                    $id = CategoryModel::add($name, $type, Session::get('user_id'));
                    if ($id) {
                        Misc::redirect('category');
                    } else {
                        $this->setData('message', 'Došlo je do greške.');
                    }
                } else if ($type == 'rashodi') {
                    $id = CategoryModel::add($name, $type, Session::get('user_id'));
                    if ($id) {
                        Misc::redirect('category');
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom dodavanja kategorije.');
                    }
                } else {
                    $this->setData('message', 'Podaci nisu pravilno uneti.');
                }
            }
        }
        /**
         * Metod edit kontrolera za rad sa kategorijama koristi se kada korisnik
         * zeli da izmeni vec napravljenu kategoriju 
         * ako su podaci tacno uneti u HTTP POST metodu.
         * @param int $id
         * @return void
         */
        public function edit($id){
            $this->setData('seo_title', 'Stranica za izmenu kategorija');
            
            $category = CategoryModel::getById($id);
            if ($category->user_id != Session::get('user_id')) {
                Misc::redirect('category');
            }
            
            if (!$category){
                Misc::redirect('category');
                $this->setData('message', 'Došlo je do grelke.');
            } else {
                $this->setData('category', $category);
            
                if (!$_POST) return;
            
                $name = filter_input(INPUT_POST, 'name');
                
                    if(!preg_match('/[A-z 0-9\-]+/', $name)) {
                        $this->setData('message', 'Podaci nisu pravilno uneti.');
                    } else {
                        $res = CategoryModel::editById($id, $name);
            
                        if ($res){
                            Misc::redirect('category');
                        } else {
                            $this->setData('message', 'Došlo je do greške prilikom izmena podataka.');
                        }
                    }
            }
        }
        /**
         * Metod delete kontrolera za rad sa kategorijama poziva se kada korisnik
         * zeli da izbrise vec napravljenu kategoriju.
         * @param int $category_id
         */
        public function delete($category_id) {
             $this->setData('seo_title', 'Izbrišite unos!');
            
            $category = CategoryModel::getById($category_id);
            if ($category->user_id != Session::get('user_id')) {
                Misc::redirect('category');
            }
            
            if ($_POST){
                
                $confirmed = filter_input(INPUT_POST, 'confirmed', FILTER_SANITIZE_NUMBER_INT);
                
                if ($confirmed == 1  and $category->user_id == Session::get('user_id')){
                    $res2= CategoryModel::deleteCategoriesFromCCC($category_id);
                    $res = CategoryModel::delete($category_id);
                        if ($res){
                        Misc::redirect('category');
                        } else {
                        $this->setData('message', 'Došlo je do greške prilikom brisanja unosa.');
                    }
                }
            }
            
            $category = CategoryModel::getById($category_id);
            $this->setData('category', $category);
        }
    }
