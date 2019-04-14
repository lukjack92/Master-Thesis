<?php

echo $d = "2019-04-10 00:29:00";
echo "</br>";
echo date("Y-m-d H:i:s",strtotime($d));
echo "</br>";
echo date("Y-m-d H:i:s",strtotime($d)+120);
echo "</br>";
echo strtotime($d);
echo "</br>";
echo time();
$DD = time();
$t = 120;
$d = $DD+$t;
echo "</br>";
echo date("Y-m-d H:i:s",time());
echo "</br>";
echo date("Y-m-d H:i:s",$d);

			if($DD > $d) {
				echo "OKE";
				
			} else {
				echo "nie";
			}

?>