<?php
class Supplier
{
    private $id;
    private $name;
    private $address;
    
    public function __construct($id, $name, $address)
    {
        if (empty($id)) {
            throw new Exception('Contract number is not set!');
        }
        if (empty($name)) {
            throw new Exception('Supplier is not set!');
        }
        if (empty($address)) {
            throw new Exception('Contract title is not set!');
        }
        

        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        
    }
    public function getID()
    {
        return $this->id;
    }
    public function getAName()
    {
        return $this->name;
    }
    public function getAddress()
    {
        return $this->address;
    }

}
