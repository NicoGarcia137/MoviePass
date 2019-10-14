<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }        

        public function IndexAdmin(){
            require_once(VIEWS_PATH."indexAdmin.php");
        }

        


    }
?>