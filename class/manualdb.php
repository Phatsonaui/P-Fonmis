<?php

include("class.db.php");
$db=new Database('nurse');
//Insert Data1

		$user = $db->Insert($db->Table = "user",$db->Field = "Name",$db->Value = "'test1'");
		if($user){
		echo"บันทึกข้อมูลเสร็จเรียบร้อย";
		}else{
			echo "บันทึกข้อมูลไม่ได้!";
		}

//Insert Data2
$insert = $db->Insert
(
	Array
    (
        "table" => "tbl_data",
        "field" => "data_id, data_username, data_password, data_email,",
        "value" => "'', 'myUsername', 'myp@ssw0rd', 'email@mydomainname.com'"
    )
);

// Show only select


$db->Table = "user";
$db->Where = "where id = '1' ";
$user = $db->Select();

foreach($user as $values=>$data){  echo $data[name];
}
// edit only select


$db->Table = "user";
$db->Set = " name = 'test2' ";
$db->Where = "where id = '1' ";
$db->Update();


// delete only select


$db->Table = "user";
$db->Where = "where id = '1' ";
$db->Delete();






?>