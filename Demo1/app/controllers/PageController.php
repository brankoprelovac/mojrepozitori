<?php
    /**
     * Klasa PageController odgovara tabeli page u bazi podataka i koristi se u
     * posebnim slucajevima kada treba korisnika redirektovati ili izlistati na
     * ekran posebne podatke iz baze podataka.
     * 
     */
    class PageController extends Controller{
        /**
         * Metod thepage kontrolera za rad sa posebnim stranicama koristi se kada
         * je potrebno preuzeti sadrzaj neke stranice iz baze podataka
         * pomocu parametara u seo_url.
         * @param string $seo_url
         */
        public function thepage($seo_url) {
            $page = PageModel::getBySeoUrl($seo_url);
            
            if (!$page) {
                #Ako stranica ne postoji, redirektujemo ka ERROR404
                $page = Misc::redirect($link);
                
            } else {
                $this->setData('seo_title', $page->seo_title);
                $this->setData('page', $page);
            }
        }
        
        public function error() {
            $page = PageModel::getBySeoUrl('404');
            
                $this->setData('seo_title', $page->seo_title);
                $this->setData('page', $page);
            
        }
    }
