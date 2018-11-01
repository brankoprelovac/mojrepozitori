<?php
    
    return [
        [ //osnovna login stranica koja pokrece login metod
            'Pattern'    => '/^login_?$/',
            'Controller' => 'Main',
            'Method'     => 'login',
        ],
        [ //osnovna logaut stranica koja pokrece logout metod
            'Pattern'    => '/^logout_?$/',
            'Controller' => 'Main',
            'Method'     => 'logout',
        ],
        [ //ruta pocetne stranice
            'Pattern'    => '/^homepage_?$/',
            'Controller' => 'Main',
            'Method'     => 'index',
        ],
        [ //pocetna stranica pre logina
            'Pattern'    => '/^home_?$/',
            'Controller' => 'Home',
            'Method'     => 'index',
        ],
        [ 
            'Pattern'    => '/^home_add_?$/',
            'Controller' => 'Home',
            'Method'     => 'add',
        ],
        [ 
            'Pattern'    => '/^successfull_registration?$/',
            'Controller' => 'Home',
            'Method'     => 'successfull_registration',
        ],
        [ //stranica sa unosima na stanje
            'Pattern'    => '/^overview_?$/',
            'Controller' => 'Overview',
            'Method'     => 'index',
        ],
        [ //stranica sa unosima na stanje
            'Pattern'    => '/^overview_value_?$/',
            'Controller' => 'Overview',
            'Method'     => 'orderByValue',
        ],
        [ //stranica pomocu koje korisnik vrsi izmene nad svojim unosima
            'Pattern'    => '/^overview_edit_([0-9]+)_?$/',
            'Controller' => 'Overview',
            'Method'     => 'edit',
        ],
        [ //stranica pomocu koje korisnik pravi nove unose na svoj racun
            'Pattern'    => '/^overview_add_?$/',
            'Controller' => 'Overview',
            'Method'     => 'add',
        ],
        [ //stranica pomocu koje korisnik brise prethodno unete podatke
            'Pattern'    => '/^overview_delete_([0-9]+)_?$/',
            'Controller' => 'Overview',
            'Method'     => 'delete',
        ],
        [ //stranica za prikaz liste kategorija.
            'Pattern'    => '/^category_?$/',
            'Controller' => 'Category',
            'Method'     => 'index',
        ],
        [ //stranica za pravljenje nove kategorije.
            'Pattern'    => '/^category_add_?$/',
            'Controller' => 'Category',
            'Method'     => 'add',
        ],
        [ //stranica za pravljenje izmena postojecim kategorijama.
            'Pattern'    => '/^category_edit_([0-9]+)_?$/',
            'Controller' => 'Category',
            'Method'     => 'edit',
        ],
        [ //osnovna stranica za prikaz kategorija
            'Pattern'    => '/^category_([a-z0-9\-]+)_?$/',
            'Controller' => 'Category',
            'Method'     => 'listByCategory',
        ],
        [ //stranica za brisanje postojecih kategorija.
            'Pattern'    => '/^category_delete_([0-9]+)_?$/',
            'Controller' => 'Category',
            'Method'     => 'delete',
        ],
        [ //stranica za prikaz liste tagova.
            'Pattern'    => '/^tag_?$/',
            'Controller' => 'Tag',
            'Method'     => 'index',
        ],
        [ //stranica za pravljenje novog taga.
            'Pattern'    => '/^tag_add_?$/',
            'Controller' => 'Tag',
            'Method'     => 'add',
        ],
        [ //stranica za pravljenje izmena postojecim tagovima.
            'Pattern'    => '/^tag_edit_([0-9]+)_?$/',
            'Controller' => 'Tag',
            'Method'     => 'edit',
        ],
        [ //stranica za brisanje postojecih tagova.
            'Pattern'    => '/^tag_delete_([0-9]+)_?$/',
            'Controller' => 'Tag',
            'Method'     => 'delete',
        ],
        [//osnovna stranica balans liste
            'Pattern'    => '/^ballance_?$/',
            'Controller' => 'Ballance',
            'Method'     => 'index'
        ],
        [//osnovna stranica za prikaz grafikona
            'Pattern'    => '/^graphs?$/',
            'Controller' => 'Graphs',
            'Method'     => 'index'
        ],
        [//osnovna stranica za prikaz grafikona
            'Pattern'    => '/^graphs_income?$/',
            'Controller' => 'Graphs',
            'Method'     => 'income'
        ],
        [//osnovna stranica za prikaz grafikona
            'Pattern'    => '/^graphs_revenue?$/',
            'Controller' => 'Graphs',
            'Method'     => 'revenue'
        ],
        [//osnovna stranica za prikaz grafikona
            'Pattern'    => '/^graphs_donut?$/',
            'Controller' => 'Graphs',
            'Method'     => 'donut'
        ],
        [//posebne stranice generisane iz podataka koji se nalaze u bazi podataka
            'Pattern'    => '/^page_([a-z0-9\_]+)_?$/',
            'Controller' => 'Page',
            'Method'     => 'thepage'
        ],
        [//osnovna stranica kontakt forme
            'Pattern'    => '/^contact_?$/',
            'Controller' => 'Contact',
            'Method'     => 'index'
        ],
        [//metod handle koji se aktivira nakon slanja poruke
            'Pattern'    => '/^contact_send_?$/',
            'Controller' => 'Contact',
            'Method'     => 'handle'
        ],
        [//poziv posebnoj aplikaciji za prikaz unosa
            'Pattern'    => '/^api_show_cash_([0-9]+)_?$/',
            'Controller' => 'ApiHome',
            'Method'     => 'show'
        ],
        [//poziv posebnoj aplikaciji za prikaz kategorija
            'Pattern'    => '/^api_show_categories_?$/',
            'Controller' => 'ApiHome',
            'Method'     => 'categories'
        ],
        [//poziv posebnoj aplikaciji za prikaz unosa za odabranu kategoriju
            'Pattern'    => '/^api_cash_category_([0-9]+)_?$/',
            'Controller' => 'ApiHome',
            'Method'     => 'category'
        ],
        [//poziv posebnoj aplikaciji za pretragu unutar unosa
            'Pattern'    => '/^api_cash_search_([A-z 0-9}]+)_?$/',
            'Controller' => 'ApiHome',
            'Method'     => 'search'
        ],
        [//poziv posebnoj aplikaciji za dodavanje novih unosa na racun
            'Pattern'    => '/^api_cash_add_?$/',
            'Controller' => 'ApiHome',
            'Method'     => 'add'
        ],
        [ #Poslednja ruta, uvek! (Pocetna stranica nakon logina)
            'Pattern'    => '/^.*$/',
            'Controller' => 'Page',
            'Method'     => 'error',
        ],
    ];
