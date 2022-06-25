<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Controller;
use App\Database;

require_once dirname(__DIR__) . '/vendor/autoload.php';



$loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new Environment($loader);
$control = new Controller($twig);
$work= new Database;

$control -> dop_form();
$control->Show($work->show());
$control -> dop_form2();

$id = $_GET['id'];
$name = $_GET['name'];
$tale = $_GET['tale'];
$price = $_GET['price'];
$action = $_GET['add'];





$Id = $_POST['id'];
if ($Id != '') {
    $control->Poisk($work->poisk($Id));
}


$Pr = $_POST['price'];
if ($Pr != '') {
    $control->Poisk($work->poiskPrice($Pr));
}

//Удаление и добавление записи через одно место
if ($id != '' && $name != '' && $tale != '' && $price != ''
    )
{
    $db = new Database;
    $db->setId($id);
    $db->setName($name);
    $db->setTale($tale);
    $db->setPrice($price);

    if (isset($_GET['add'])){
        $db->save();}

    if (isset($_GET['delete'])){
        $db->del($id);
    }
    header('Refresh: 0; url=index.php');
}

