<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Domain/Supplier.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Repository/suplInterface.php');
class SupplierService
{
    private $repositorys;
    public function __construct(suplInterface $repositorys)
    {
        $this->repositorys = $repositorys;
    }
    public function getAllSuplId()
    {
        return $this->repositorys->getSupplierNumber();
    }
}