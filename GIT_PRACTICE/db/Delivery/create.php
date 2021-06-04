<?php
session_start();
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Domain/Contract.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Repository/MySQLContractRepository.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Service/ContractService.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Util/MySQLConnectionUtil.php');

$repository = new MySQLContractRepository();
$service = new ContractService($repository);

$conn = MySQLConnectionUtil::getConnection();
$number = $_POST['number'];
//$agreed = $_POST['agreed'];
$supplier = $_POST['supplier'];
$title = $_POST['title'];
$note = $_POST['note'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integri-ty="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" cros-sorigin="anonymous">
    <title>create</title>
    <style>
        body{
            background-color: #282C34;
            color:#98C379;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="contracts.php">Delivery</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="contracts.php">Contracts</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="logout.php" method="post">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </div>
</nav>
<div class="row my-3 mx-1">
    <div class="col-4">
        <ul class="list-group">
            <li class="list-group-item active">Contracts</li>
            <?php foreach ($service->getAllContracts() as $contract) { ?>
                <li class="list-group-item">
                    <a href="contracts.php?details=<?= $contract->getNumber() ?>">
                        #<?= $contract->getNumber() ?>, <?= $contract->getAgreed() ?>, <?= $contract->getSupplier() ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
<form action="" method="post">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Номер договора: </label>
        <input type="number" class="form-control" name="number">
       
        <label for="exampleFormControlSelect1">Поставщик: </label>
        <input type="number" class="form-control" name="supplier">
        <label for="exampleFormControlSelect1">Название: </label>
        <input type="text" class="form-control" name="title">
        <label for="exampleFormControlSelect1">Заметки: </label>
        <textarea class="form-control" name="note"></textarea>
        <button onclick="return proverka();" type="submit" class="btn btn-primary mb-2"  name="">Подтвердить</button>
       <script>
            function proverka() {
                if (confirm("Подтвердить")) {
                return alert("Контракт успешно добавлен");
                } else {
                    return alert("произошла ошибка!");
                }
            }
       </script>
    </div>
</form>
<?php
$service->createContract($number, $supplier, $title, $note);
?>
</body>
</html>
