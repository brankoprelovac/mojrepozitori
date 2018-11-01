<?php
    /**
     * Klasa MainController odgovara tabeli user u bazi podataka i koristi se za
     * registraciju, prijavu i odjavljivanje na Veb sajt.
     */
    class MainController extends Controller{
        /**
         * Metod index kontrolera za rad sa korisnicima prikazuje putanje ka
         * stranicama za registraciju i login.
         */
        function index(){
            $this->setData('seo_title', 'Aplikacija za vođenje ličnih finansija');
        }
        /**
         * Metod login kontrolera za rad sa korisnicima koristi se kada korisnik
         * zeli da se uloguje na Veb sajt ako su podaci tacno uneti u HTTP POST metodu.
         */
        function login(){
            $this->setData('seo_title', 'Ulogujte se.');
            
            if ($_POST) {
                $username = filter_input(INPUT_POST, 'username');
                $password = filter_input(INPUT_POST, 'password');
                
                if (preg_match('/^[a-z0-9]{4,}$/', $username) and preg_match('/^.{6,}$/', $password)) {
                    $passwordHash = hash('sha512', $password . Configuration::SALT);
                    $user = UserModel::getByUsernameAndPasswordHash($username, $passwordHash);
                    
                    if ($user){
                        #podesavam u sesiji podatke o korisniku
                        Session::set('user_id', $user->user_id); #korisnicki id
                        Session::set('username', $username); #korisnicki username
                        Session::set('user_ip', filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_FLAG_IPV4)); #ip adresa korisnika
                        Session::set('user_agent', filter_input(INPUT_SERVER, 'HTTP_USER_AGENT')); #brauzer koji korisnik koristi
                        
                        Misc::redirect('overview');
                    } else{
                        $this->setData('message', 'Pogrešno korisničko ime ili šifra.');
                    }
                    
                } else {
                    $this->setData('message', 'Pogrešno korisničko ime ili šifra.');
                }
            }
        }
        /**
         * Metod logout kontrolera za rad sa korisnicima koristi se kada korisnik
         * zeli da se odjavi sa Veb sajta.
         */
        function logout(){
            Session::end();
            Misc::redirect('login');
        }
        
        function register(){
            
        }
    }
