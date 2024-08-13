<?php 

class Contact
{
    public $host="localhost";
    public $user="root";
    public $pass="";
    public $db="tap";
    public $mysqli;
    
    function __construct()
    {
        return $this->mysqli=new mysqli($this->host, $this->user, $this->pass, $this->db);
    }

    function offer($data)
    {
        $offer_occupation=$data['offer_occupation'];
        $offer_start_date=$data['offer_start_date'];
        $offer_end_date=$data['offer_end_date'];
        $offer_salary=$data['offer_salary'];
        
        $q="insert into offer set offer_occupation='$offer_occupation', offer_start_date='$offer_start_date', offer_end_date='$offer_end_date', offer_salary='$offer_salary', status='sent'";
        $data= $this->mysqli->query($q);
    }

}

?>