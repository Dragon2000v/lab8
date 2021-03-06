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
            <select method="post" name="number">
            <?php foreach ($service->getAllContracts() as $contract) { ?>
            <option value="<?= $contract->getNumber() ?>"> <?= $contract->getNumber() ?></option>
            <?php } ?>
            </select>
            <button onclick="return proverka();" type="submit" class="btn btn-primary mb-2"  name="">??????????????????????</button>
       <script>
            function proverka() {
                if (confirm("??????????????????????")) {
                return alert("???????????????? ?????????????? ????????????");
                } else {
                    return alert("?????????????????? ????????????!");
                }
            }
       </script>
        </div>
    </form>

<?php
$service->deleteContract($number);
?>
</body>
</html>