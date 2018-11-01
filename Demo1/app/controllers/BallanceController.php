<?php
    /**
     * Klasa BallanceController ne odgovara ni jednoj tabeli u bazi podataka vec
     * uzima podatke iz tabela cash i category, koristi se za prikaz trenutnog
     * stanja na racunu korisnika, kao i kompletan iznos prihoda i rashoda pojedinacno.
     */
    class BallanceController extends AdminController {
        /**
         * Metod index klase za kontrolu nad vrednostima prikazuje osnovnu stranicu
         * na kojoj se nalaze podaci o totalnoj sumi prihoda i totalnoj sumi
         * rashoda koje korisnik ima na svom racunu.
         */
        public function index(){
            $this->setData('seo_title', 'Balans | Aplikacija za vođenje ličnih finansija'); 
        
            /**
             * Blok kod za izlistavanje vrednosti svih unosa koji imaju tip
             * 'prihodi', izlistani u niz.
             */
            $prihodi = BallanceModel::getPositiveEntries(Session::get('user_id'));
            if (!$prihodi){
                Misc::redirect('homepage');
                $this->setData('message', 'Greška.');
            } else {
                    
                $this->setData('prihodi', $prihodi);
                

                $suma_prihoda = array();
                    foreach ($prihodi as $entrie){
                    array_push($suma_prihoda, $entrie->value);
                    
                }
                $prihodi_total = array_sum($suma_prihoda);
                $this->setData('prihodi_total', $prihodi_total);
            } 
        
            
            
            /**
             * Blok kod za izlistavanje vrednosti svih unosa koji imaju tip
             * 'rashodi', izlistani u niz.
             */
            $rashodi = BallanceModel::getNegativeEntries(Session::get('user_id'));
            if (!$rashodi){
                Misc::redirect('homepage');
                $this->setData('message', 'Greška.');
            } else {
                    
                $this->setData('rashodi', $rashodi);
                

                $suma_rashoda = array();
                    foreach ($rashodi as $entrie){
                    array_push($suma_rashoda, $entrie->value);
                    
                }
                $rashodi_total = array_sum($suma_rashoda);
                $this->setData('rashodi_total', $rashodi_total);
            }
        }
    }
