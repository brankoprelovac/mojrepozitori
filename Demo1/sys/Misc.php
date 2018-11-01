<?php
    final class Misc {
        public static function url($link, $text){
            echo '<a href="' . Configuration::BASE_URL . $link . '">' . $text . '</a>';
        }
        public static function redirect($link){
            ob_clean();
            header('Location: ' . Configuration::BASE_URL . $link);
            exit;
        }
        
        public function urlWithActive($link, $text, $controller){
            global $FoundRoute;
            
            if ($FoundRoute['Controller'] == $controller) {
                echo '<a class="active" href="' . Configuration::BASE_URL . $link . '">' . $text . '</a>';
            } else {
                echo '<a href="' . Configuration::BASE_URL . $link . '">' . $text . '</a>';
            }
        }
    }
