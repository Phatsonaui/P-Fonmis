<?php
session_start();
function isUserVerified() {
    return isset($_SESSION['ud_id_fon']) && 
           isset($_SESSION['lg_ref_fon']) && 
           isset($_SESSION['lg_date_fon']) && 
           isset($_SESSION['verify_fon']) && 
           $_SESSION['verify_fon'] === "FonbuuFonmis";
}