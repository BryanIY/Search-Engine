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
    
    function contact_us($data)
    {
        $fname=$data['name'];
        $lname=$data['surname'];
        $email=$data['email'];
        $phone=$data['phone'];
        $message=$data['message'];
        $q="insert into contact_us set first_name='$fname', last_name='$lname', email='$email', phone='$phone', message='$message'";
       $data= $this->mysqli->query($q);


       //if($data==true){
           //$body="One message received from engineray contact us. details are below..<br> first_name='$fname', last_name='$lname', email='$email', phone='$phone', message='$message'";
           //return $this->sent_mail("codyzcy@gmail.com", "Message received from Engineray", $body);
       //}
    }
    
    //function sent_mail($to,$subject,$body)
    //{
        //$mailFromName="Engineray";
        //$mailFrom="codyzcy@gmail.com";

        //$mailHeader = 'MIME-Version: 1.0'."\r\n";
        //$mailHeader .= "From: $mailFromName <$mailFrom>\r\n";
        //$mailHeader .= "Reply-To: $mailFrom\r\n";
        //$mailHeader .= "Return-Path: $mailFrom\r\n";

        //$mailHeader .= 'X-Mailer: PHP'.phpversion()."\r\n";
        //$mailHeader .= 'Content-Type: text/html; charset=utf-8'."\r\n";

            //if(mail($to, $subject, $body, $mailHeader))
            //{
             //return true;
            //}
            //else
            //{
            //return false;
            //}
    //}
}


?>