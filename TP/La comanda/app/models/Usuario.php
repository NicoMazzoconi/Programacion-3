<?php  
namespace App\Models;
 
class usuario extends \Illuminate\Database\Eloquent\Model {  
    public $id;
    public $account;
    public $password;
    public $tipo;
}
?>