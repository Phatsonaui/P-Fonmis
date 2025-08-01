<?php

function random_strings($length_of_string) 
{ 
   $str= '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
   //คำสั่งจัดเรียงลำดับตัวอักษรในข้อความแบบสุ่ม
   $str = str_shuffle($str);
   //ทำการตัด string ตามจำนวนที่ใส่เข้ามา
   $resultChar = substr($str, 0, $length_of_string); 
   return $resultChar;
}
function random_number($length_of_string) 
{ 
   $str= '0123456789'; 
   //คำสั่งจัดเรียงลำดับตัวอักษรในข้อความแบบสุ่ม
   $str = str_shuffle($str);
   //ทำการตัด string ตามจำนวนที่ใส่เข้ามา
   $resultChar = substr($str, 0, $length_of_string); 
   return $resultChar;
}


?>