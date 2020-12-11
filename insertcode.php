<?php 

require_once "Class/codeDB.php";

$code = new CodeDB('Localhost', 'trashcode', 'root', '');

session_start();

$title = filter_var($_POST['code_title'], FILTER_SANITIZE_STRING);
$content = filter_var($_POST['code'], FILTER_SANITIZE_STRING);

if(mb_strlen($title) < 41) {

    if(!empty($content) and !empty($title)) {

        if(mb_strlen($content) > 4000) {

            $_SESSION['msg'] = "O código deve ter no máximo 4000 caracteres";
            header('location: ./frontend/code.php');

        } else {
            date_default_timezone_set('America/Sao_Paulo');
            $code->insert($title, $content , $_SESSION['id'], date('Y/m/d H:i:s'));
            $_SESSION['msg'] = "Seu código foi salvo com sucesso!";
            header('location: ./frontend/code.php');

        }
        
    } else {

        $_SESSION['msg'] = "Todos os campos devem estar preenchidos!";
        header('location: ./frontend/code.php');
    }

} else {
    $_SESSION['msg'] = "O título deve ter no máximo 40 caracteres";
    header('location: ./frontend/code.php');
}



