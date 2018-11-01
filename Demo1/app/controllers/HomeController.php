<?php
    /**
     * Klasa HomeController odgovara tabeli user u bazi podataka i koristi se 
     * za iscitavanje, brisanje i dodavanje korisnika od strane administratora Veb
     * stranice.
     */
    class HomeController extends Controller {
        /**
         * Osnovna stranica index kontrolera za rad sa korisnicima prikazuje
         * listu svih registrovanih i aktivnih korisnika na Veb aplikaciji.
         */
        public function index(){
            $this->setData('seo_title', 'Spisak korisnika | Aplikacija za vođenje ličnih finansija');
          $korisnici = HomeModel::getAll();
          $this->setData('korisnici', $korisnici);
        }
        /*
         * Funkcija edit kontrolera za rad sa korisnicima koristi se za vrsenje
         * izmena na prethodno napravljenim korisnickim nalozima  ako su podaci
         * tacno uneti u HTTP POST metodu.
         * @param int user_id
         */
        public function edit($user_id) {
            if ($_POST){
                #izmena vrednosti
                #redirekcija na listu
                
                $username = filter_input(INPUT_POST, 'username');
                $lastname = filter_input(INPUT_POST, 'lastname');
                $email = filter_input(INPUT_POST, 'email');
                
                if (!preg_match('/^[a-z0-9]{4,}$/', $username) or !preg_match('[A-z 0-9\-]+', $fullname) or $email == '') {
                    $this->setData('message', 'Izmene nisu tačno unete.');
                } else {
                    $res = HomeModel::editById($user_id, $username, $lastname, $email);
                    if ($res){
                        Misc::redirect('homepage');
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom izmene.');
                    }
                }
                
            }
            
            $user = HomeModel::getById($user_id);
            $this->setData('korisnik', $user);
        }
        /**
         * Funkcija delete kontrolera za rad sa korisnicima koristi se kada admin
         * zeli da izbrise prethodno napravljen korisnicki nalog pomocu parametra
         * user_id ako su podaci tacno uneti u HTTP POST metodu.
         * @param int $user_id
         */
        public function delete($user_id) {
            if ($_POST){
                #brisanje vrednosti
                #redirekcija na listu
                
                $confirmed = filter_input(INPUT_POST, 'confirmed', FILTER_SANITIZE_NUMBER_INT);
                
                if ($confirmed == 1){
                    $res = HomeModel::delete($user_id);
                    if ($res){
                        Misc::redirect('homepage');
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom brisanja korisnika.');
                    }
                }
            }
            
            $user = HomeModel::getById($user_id);
            $this->setData('korisnik', $user);
        }
        /**
         * Funkcija add koristi se kada administrator zeli rucno da napravi korisnicki
         * nalog ili kada novi korisnik zeli da se registruje na Veb aplikaciju
         * putem formulara.
         */
        public function add() {
            if ($_POST){
                
                $username = filter_input(INPUT_POST, 'username');
                $password = filter_input(INPUT_POST, 'password');
                $password2 = filter_input(INPUT_POST, 'password2');
                $fullname = filter_input(INPUT_POST, 'fullname');
                $email = filter_input(INPUT_POST, 'email');
                
                if (!preg_match('/^[a-z0-9]{4,}$/', $username) or !preg_match('/[A-z 0-9\-]+$/', $fullname) or $email == '' or $password != $password2) {
                    $this->setData('message', 'Podaci nisu tačno uneti.');
                } else {
                    $passwordHash = hash('sha512', $password . Configuration::SALT);
                    $res = HomeModel::add($username, $passwordHash , $fullname, $email);
                    if ($res){
                        Misc::redirect('successfull_registration');
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom dodavanja. Korisničko ime je verovatno zauzeto.');
                    }
                }    
            }
        }
        
        public function successfull_registration(){
            $this->setData('seo_url', 'Registracija uspešna');
        }
    }
