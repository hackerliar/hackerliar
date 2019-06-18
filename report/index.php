<?php
date_default_timezone_set('Europe/London');
$now = date('Y-m-d h:i:s');
$reports = "Conversions";

$tanggal = date('Y-m-d', strtotime('today'));

$filename = "temp/".$reports."-".$tanggal.".json";

echo "<b>Tanggal : ".$tanggal."</b><br><br>";

if (file_exists($filename)) {
	$json = @file_get_contents($filename);		
	$results = json_decode($json,true);
} else {
	echo "Data tidak ditemukan";
	exit;
}
$table = array(
	"ID" => "click_id",
	"Token 1" => "token_1",
	"Token 2" => "token_2",
	"Country" => "country",
	"Earning" => "payout",
);
?>
<table class="table" border="1">
	<thead>
		<tr>
			<th data-field='n' data-sortable='true' class='no'>#</th>
<?php
	foreach ($table as $td => $v){
		echo "<th data-field='$td' data-sortable='true' class='$v'>$td</th>";
	}
?>
		<tr>
	</thead>	
	<tbody>
<?php
	$n = 1;
	if (count($results["conversions"]["conversion"])>0){
		foreach ($results["conversions"]["conversion"] as $hasil){
			$sum += $hasil["payout"];
			echo "<tr class='$reports'>";
			echo "<td class='no'>".$n++."</td>";
			foreach ($table as $v){
				if (isset($hasil[$v]))
					echo "<td class='$v'>".$hasil[$v]."</td>";
			}	
			echo "</tr>";
		}
	}
?>	
	</tbody>
	<tfoot>
		<tr>
			<td class='no'></td>
		<?php
			$len = count($table);
			foreach ($table as $k=>$v){
				$s = "";
				if ($k == "Earning"){
					$s = "<span id='sum'>".round($sum,2)."</span>";//sprintf('%01.2f', round($sum,2));//money_format("%i", round($sum,2));
				}
				echo "<td  class='$v'><b>$s</b></td>";					
			}
		?>
		
		</tr>
	</tfoot>	
</table>
