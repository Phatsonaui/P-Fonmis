<?php
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai พ.ศ. $strYear";
	}
	function DateThaiSub($strDate_sub)
	{
		$strYear_sub = date("Y",strtotime($strDate_sub))+543-2500;
		$strMonth_sub= date("n",strtotime($strDate_sub));
		$strDay_sub= date("j",strtotime($strDate_sub));
		
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth_sub];
		return "$strDay_sub $strMonthThai $strYear_sub";
	}
	function DateEng($strDate_eng)
	{
		$strYear_eng = date("Y",strtotime($strDate_eng));
		$strMonth_eng= date("n",strtotime($strDate_eng));
		$strDay_eng= date("j",strtotime($strDate_eng));
		
		$strMonthCut = Array("","January","February","March","April","May","June","July","August","September","October","November","December");
		$strMonthEng=$strMonthCut[$strMonth_eng];
		return "$strDay_eng $strMonthEng $strYear_eng";
	}
	function DateEngSub($strDate_sub) {
	    $strYear_sub = date("Y", strtotime($strDate_sub)) - 2500 + 543;
	    $strMonth_sub = date("n", strtotime($strDate_sub));
	    $strDay_sub = date("j", strtotime($strDate_sub));
	    
	    $strMonthCut = array("", "Jan.", "Feb.", "Mar.", "Apr.", "May", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec.");
	    $strMonthEng = $strMonthCut[$strMonth_sub];
	    
	    return "$strDay_sub $strMonthEng $strYear_sub";
	}
	function TimeEng($strTime) {
	    $strHour = date("h", strtotime($strTime));
	    $strMinute = date("i", strtotime($strTime));
	    $strMeridian = date("A", strtotime($strTime)); // AM/PM notation

	    return "$strHour:$strMinute $strMeridian";
	}
	function DateThaiMonth($month){
	  switch($month){
	    case "01": return "มกราคม"; break;
	    case "02": return "กุมภาพันธ์"; break;
	    case "03": return "มีนาคม"; break;
	    case "04": return "เมษายน"; break;
	    case "05": return "พฤษภาคม"; break;
	    case "06": return "มิถุนายน"; break;
	    case "07": return "กรกฎาคม"; break;
	    case "08": return "สิงหาคม"; break;
	    case "09": return "กันยายน"; break;
	    case "10": return "ตุลาคม"; break;
	    case "11": return "พฤศจิกายน"; break;
	    case "12": return "ธันวาคม"; break;
	  }
	}
	function DateEngMonth($month){
	  switch($month){
	    case "01": return "January"; break;
	    case "02": return "February"; break;
	    case "03": return "March"; break;
	    case "04": return "April"; break;
	    case "05": return "May"; break;
	    case "06": return "June"; break;
	    case "07": return "July"; break;
	    case "08": return "August"; break;
	    case "09": return "September"; break;
	    case "10": return "October"; break;
	    case "11": return "November"; break;
	    case "12": return "December"; break;
	  }
	}
	function ThaiDatetime($timestamp) {
        // แยกวันที่
        $date = date('Y-m-d', strtotime($timestamp));

        // แยกเวลา
        $times = date('H:i:s', strtotime($timestamp));

        // แปลง timestamp เป็น ชม. : น.
        $time = strftime(' เวลา : %H.%M น.', strtotime($times));


        // แปลงปีให้เป็นพ.ศ.
        $formattedDatetime = DateThai($date)." ".$time;


        return $formattedDatetime;
    }
	function Convert_thai($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".","");
    $pt = strpos($amount_number , ".");
    $number = $fraction = "";
    if ($pt === false) 
        $number = $amount_number;
    else
    {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }
    
    $ret = "";
    $baht = ReadNumber ($number);
    if ($baht != "")
        $ret .= $baht . "บาท";
    
    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else 
        $ret .= "ถ้วน";
    return $ret;
}

function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000)
    {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }
    
    $divider = 100000;
    $pos = 0;
    while($number > 0)
    {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : 
            ((($divider == 10) && ($d == 1)) ? "" :
            ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}
function ThaiToNumeric($text) {
    $thaiNumbers = array(
        '๐' => 0, '๑' => 1, '๒' => 2, '๓' => 3, '๔' => 4,
        '๕' => 5, '๖' => 6, '๗' => 7, '๘' => 8, '๙' => 9
    );
    // แปลงตัวเลขไทยเป็นตัวเลขอาราบิก
    $numericText = str_replace(array_keys($thaiNumbers), array_values($thaiNumbers), $text);
    return $numericText;
}

	
?>