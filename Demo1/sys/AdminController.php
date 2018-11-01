<?php
    class AdminController extends Controller{
        final function __pre(){
            if (!Session::exists('user_id')){
                Misc::redirect('logout');
            }
        }
    }
