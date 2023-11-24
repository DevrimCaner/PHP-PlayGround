<?php
if(!isset($_GET['page'])){
    $_GET['page'] = 'home';
}
require_once 'library/db.php';
require_once 'components/header.php';
$jsfile = '';
//Page
switch ($_GET['page']) {
    case 'home':
        require_once 'pages/home.php';
        $jsfile = 'home.js';
    break;
    case 'courses':
        require_once 'pages/courses.php';
        $jsfile = 'courses.js';
    break;
    case 'students':
        require_once 'pages/students.php';
        $jsfile = 'students.js';
    break;
    
    default:
        echo $_GET['page'];
    break;
}

require_once 'components/footer.php';
?>