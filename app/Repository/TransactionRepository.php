<?php
namespace App\Repository;

use App\Model\produks;
use App\Model\kategori;
use App\Model\transaction_detail;
use App\Model\transaction;

class TransactionRepository{

    Public Function GetTransactionList(){
        return transaction_detail::with('produks')->with('produks.kategoris')->orderBy('created_at', 'DESC')->get(); 
    }

    Public Function createtransaction($data,$status)
    {
  		$transId=$this->create_transaction($status);

  		for($i=0;$i<count($data);$i++){
  			$data[$i]['transaction_id']=$transId;
  			// $data[$i]['transaction_id']=1;
  			$data[$i]['id_produk']=$data[$i]['id'];
  			unset($data[$i]['id']);
  		}
    	// print_r($data);exit();

    	return transaction_detail::insert($data);


    }

    public Function create_transaction($status)
    {
      
    	$data = [
    		'transaction_status_id'=>$status,
    		'invoice_number'=>$this->generateRandomString(15),
    		'tracking_number'=>'-',
    	];
    	// $data = $arrayName = array(
    	// 	'transaction_status_id'=>1,
    	// 	'invoice_number'=>date().'abc123'
    	// );
    	$id = transaction::insertGetId($data);
    	return $id;
    } 

    private function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	Public Function GetTransactionID()
	{
		$data = transaction::Where('id', 7)->with('detail','detail.produks')->get();

		print_r(json_encode($data));
		// return 
	}
}