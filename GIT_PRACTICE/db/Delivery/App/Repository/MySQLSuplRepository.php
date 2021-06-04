<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Domain/Supplier.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Delivery/App/Util/MySQLConnectionUtil.php');
require_once('suplInterface.php');
class MySQLSuplRepository implements suplInterface
{
   
       public function getSupplierNumber(){
        $conn = MySQLConnectionUtil::getConnection();
        $supplier = array();
        $query = 'SELECT id FROM supplier';
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $suppl = new Supplier(
                $row['id'],
                $row['name'],
                $row['address']
                
            );
            array_push($supplier, $suppl);
        }
        mysqli_close($conn);
        return $supplier;
    }
}
