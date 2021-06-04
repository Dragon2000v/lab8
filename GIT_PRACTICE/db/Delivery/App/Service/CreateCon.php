<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Domain/Contract.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Repository/MySQLContractRepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Service/ContractService.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Util/MySQLConnectionUtil.php');
$repository = new MySQLContractRepository();
$service = new ContractService($repository);


$conn = MySQLConnectionUtil::getConnection();
$number = $_POST['number'];

$supplier = $_POST['supplier'];
$title = $_POST['title'];
$note = $_POST['note'];

$service->createContract($number, $supplier, $title, $note);
