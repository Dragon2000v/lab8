<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/Delivery/App/Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Delivery/App/Domain/Contract.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Delivery/App/Repository/MySQLContractRepository.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Delivery/App/Service/ContractService.php');
if (!isset($_SESSION['username']))
{
    $controller->redirect('login');
}
$repository = new MySQLContractRepository();
$service = new ContractService($repository);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contracts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integri-ty="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" cros-sorigin="anonymous">
    <style>
        
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
    <div class="col-8">
        <?php
        if (isset($_GET['details']))
        {
            try
            {
                $contract = @$service->getContractByNumber($_GET['details']);
                ?>
                <form action="edit" method="post">
                    <div class="form-group row">
                        <label for="contractNumber" class="col-sm-2 col-form-label">Contract number</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="contractNumber" value="<?= $contract->getNumber() ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contractDate" class="col-sm-2 col-form-label">Contract date</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="contractDate" value="<?= $contract->getAgreed() ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="supplier" value="<?= htmlspecialchars($contract->getSupplier()) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="title" value="<?= htmlspecialchars($contract->getTitle()) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" readonly rows="5" id="note"><?= htmlspecialchars($contract->getNote()) ?></textarea>
                        </div>
                    </div>
                </form>

                <?php
            }
            catch (Exception $e)
            {
                ?><div class="alert alert-danger" role="alert"><?= $e->getMessage() ?></div><?php
            }
        }
        else
        {
            ?>
            <style>
                #some_block > div{
                    width: 33%;
                    max-width: 33%;
                    float: left;
                    margin-top: 5%;
                }
                #some_block > div > div {
                    width: 100%;
                    height: 200px;
                }
            </style>
            <div id="some_block">
                <div>
                    <a class="btn btn-success" href="create.php" role="button">Новий контракт</a>                    
                    <a class="btn btn-warning" href="edit.php" role="button">Изменения</a>
                    <a class="btn btn-danger" href="delete.php" role="button">Удалить</a>
                </div>
            </div>
            <?php

        }
        ?>
    </div>
</div>
</body>
</html>