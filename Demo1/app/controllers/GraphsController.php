<?php
    /**
     * Klasa GraphsController koristi se za kontrolu nad grafikonima, koji su
     * pozvani putem javascript. Javascript preuzima podatke i prosledjuje ih u view.
     */
    class GraphsController extends AdminController{
        /**
         * Osnovna funkcija index kontrolera za rad sa grafikonima.
         */
        public function index(){
            $this->setData('seo_title', 'Lista grafikona | Aplikacija za vođenje ličnih finansija');
        }
        /**
         * Funkcija donut kontrolera za rad sa grafikonima salje podatke u
         * javascriptu koja predstavlja jedan "Donut chart", sa prikazom kompletnih
         * prihoda i rashoda koje korisnik ima na svom racunu.
         */
        public function donut(){
            $this->setData('seo_title', 'Grafikoni');
            
            $prihodi = BallanceModel::getPositiveEntries(Session::get('user_id'));
            
            if (!$prihodi){
                Misc::redirect('homepage');
                $this->setData('message', 'Ne postoje unosi za odabranu kategoriju.');
            } else {
                
                $this->setData('prihodi', $prihodi);
                
                $suma_prihoda = array();
                foreach ($prihodi as $entrie){
                    array_push($suma_prihoda, $entrie->value);
                    
                    //$this->setData('suma_prihoda', $suma_prihoda);
                }
                $prihodiTotal = array_sum($suma_prihoda);
                $this->setData('suma_prihoda', $prihodiTotal);
            }
            
            
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
                $this->setData('suma_rashoda', $rashodi_total);
            }
        }
        /**
         * Funkcija income kontrolera za rad sa grafikonima salje podatke u
         * javascriptu koja putem "Bar chart" grafikona prikazuje sve prihode
         * koje je korisnik ostvario/la u poslednja tri meseca.
         */
        public static function income(){
            $this->setData('seo_title', 'Grafik za prikaz prihoda u poslednjih tri meseca');

            $prihodiPoMesecima = BallanceModel::getAllByUserAndDateRange(Session::get('user_id'), '2018-08-01', '2018-10-31');
            if (!$prihodiPoMesecima) {
                    Misc::redirect('graphs');
            } else {
                foreach ($prihodiPoMesecima as $month){
                    
                    if ($month->godina_mesec == '2018-08'){
                        $this->setData('avgust', $month);
                    } elseif ($month->godina_mesec == '2018-09'){
                        $this->setData('septembar', $month);  
                    } elseif ($month->godina_mesec == '2018-10'){
                        $this->setData('oktobar', $month);
                    } 
                }
            } 
	}

// isti princip je za grafik rashoda

    public static function revenue(){
	
	$this->setData('seo_title', 'Grafik za prikaz rashoda u poslednjih tri meseca');

	$rashodiPoMesecima = BallanceModel::getAllByUserAndDateRange(Session::get('user_id'), '2018-08-01', '2018-10-31');
            if (!$rashodiPoMesecima) {
                    Misc::redirect('graphs');
            } else {
                foreach ($rashodiPoMesecima as $month){
                    
                    if ($month->godina_mesec == '2018-08'){
                        $this->setData('avgust', $month);
                    } elseif ($month->godina_mesec == '2018-09'){
                        $this->setData('septembar', $month);  
                    } elseif ($month->godina_mesec == '2018-10'){
                        $this->setData('oktobar', $month);
                    } 
                }
            } 

    }
       
}