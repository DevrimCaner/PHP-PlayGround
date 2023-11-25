<?php
if(!isset($_GET['page'])){
    $_GET['page'] = 'home';
}
$PageName = $_GET['page'];
require_once 'library/db.php';
require_once 'components/header.php';
$jsfile = '';
//Page
switch ($PageName) {
    case 'home':
        require_once 'pages/home.php';
        $jsfile = 'home.js';
    break;
    case 'students':
        require_once 'pages/students.php';
        $jsfile = 'students.js';
    break;
    case 'courses':
        require_once 'pages/courses.php';
        $jsfile = 'courses.js';
    break;
    
    default:
        echo $_GET['page'];
    break;
}

require_once 'components/footer.php';
?>