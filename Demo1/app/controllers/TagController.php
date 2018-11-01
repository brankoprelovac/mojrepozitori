<?php
    /**
     * Klasa kontrolera aplikacije za rad sa tagovima.
     */
    class TagController extends AdminController {
        /**
         * Indeks metod kontrolera za rad sa tagovima.
         */
        public function index(){
            $this->setData('seo_title', 'Tagovi | Aplikacija za vođenje ličnih finansija');
            $this->setData('tags', TagModel::getAll());
        }
        
        /**
         * Add metod kontrolera za rad sa tagovima koristi se za prikaz formulara
         * za unos novog taga ako su podaci tacno uneti u HTTP POST metodu.
         */
        public function add(){
            $this->setData('seo_title', 'Napravite novi tag.');
            
            if($_POST){
                
                $name = filter_input(INPUT_POST, 'name');
                $classes = filter_input(INPUT_POST, 'classes'); 
                
                
                if($name == '' or $classes == '' ) {
                    $this->setData('message', 'Podaci nisu pravilno uneti.');
                } else {
                    $id = TagModel::add($name, $classes);
                    if ($id) {
                        Misc::redirect('tag');
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom dodavanja taga.');
                    }
                }
            }
        }
        /**
         * Metod edit kontrolera za rad sa kategorijama koristi se kada korisnik
         * zeli da izmeni vec napravljenu kategoriju ako su podaci tacno uneti
         * u HTTP POST metodu.
         * @param int $id
         * @return void
         */
        public function edit($id){
            $this->setData('seo_title', 'Stranica za izmenu taga');
            
            $tag = TagModel::getById($id);
            
            
            if (!$tag){
                Misc::redirect('tags');
                $this->setData('message', 'Došlo je do greške.');
            } else {
                $this->setData('tags', $tag);
            
                if (!$_POST) return;
            
                $name = filter_input(INPUT_POST, 'name');
                $classes = filter_input(INPUT_POST, 'classses');
            
                $res = TagModel::editById($id, $name, $classes);
            
                if ($res){
                    Misc::redirect('tags');
                } else {
                    $this->setData('message', 'Došlo je do greške prilikom izmena podataka.');
                }
            }
        }
        /**
         * Metod delete kontrolera za rad sa kategorijama poziva se kada korisnik zeli da izbrise vec napravljenu kategoriju.
         * @param int $category_id
         */
        public function delete($tag_id) {
             $this->setData('seo_title', 'Izbrišite unos!');
            
            
            
            if ($_POST){
                
                $confirmed = filter_input(INPUT_POST, 'confirmed', FILTER_SANITIZE_NUMBER_INT);
                
                if ($confirmed == 1){
                    $res = TagModel::delete($tag_id);
                        if ($res){
                        Misc::redirect('tag');
                        } else {
                        $this->setData('message', 'Došlo je do greške prilikom brisanja unosa.');
                    }
                }
            }
            
            $tag = TagModel::getById($tag_id);
            $this->setData('tags', $tag);
        }
    }
