<?php
    /**
     * Klasa ContactController odgovara tabeli contact u bazi podataka i koristi
     * se za rad sa porukama koje korisnici ostavljaju administratoru Veb stranice.
     */
    class ContactController extends Controller{
        /**
         * Metod index kontrolera za poruke prikazuje osnovnu stranicu
         * sa poljima za unos poruke.
         */
        public function index(){
            $this->setData('seo_title', 'Kontaktirajte nas | Aplikacija za vođenje ličnih finansija');
        }
        
        /**
         * Metod handle poziva se kada korisnik posalje prethodno otkucanu
         * poruku ako su podaci tacno uneti u HTTP POST metodu.
         */
        public function handle(){
            $this->setData('seo_title', 'Poruka');
            
            if ($_POST) {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $subject = filter_input(INPUT_POST, 'subject');
                $text = filter_input(INPUT_POST, 'text');
                
                if(!preg_match('/[A-z 0-9\-]+/', $subject) or !preg_match('/[A-z 0-9\-]+/', $text)) {
                    
                    $this->setData('message', 'Došlo je do greške, niste pravilno uneli podatke.');
                } else {
                    $res = ContactModel::insert($email, $subject, $text);
                    if ($res){
                        $this->setData('message', 'Vaša poruka je poslata. Hvala!');
                    } else {
                        $this->setData('message', 'Došlo je do greške prilikom slanja.');
                    }
                }
            } else {
                $this->setData('message', 'Došlo je do greške, niste pravilno uneli podatke.');
            }
        }
    }
