<?php

session_start();

if(isset($_SESSION['success_msg'])) {
    echo $_SESSION['success_msg'];
} else if(isset($_SESSION['fail_msg'])) {
    echo $_SESSION['fail_msg'];
}