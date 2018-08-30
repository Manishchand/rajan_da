<?php
//model
$file = 'survey.csv';
//controller
if (file_exists($file)) {
	$my_file = fopen($file, "r") or die("Unable to open file!");
	$array_to_store_data = [];
	while (!feof($my_file)) {
		$data = fgets($my_file);
		$data = explode(',', trim($data));
		if (!array_key_exists($data[0], $array_to_store_data)) {
			$array_to_store_data[$data[0]]['male'] = 0;
			$array_to_store_data[$data[0]]['female'] = 0;
		}
		if ($data[3] == 'male') {
			$array_to_store_data[$data[0]]['male']++;
		}
		else
			$array_to_store_data[$data[0]]['female']++;
	}
	fclose($my_file);

	//view part
	$first_line_remove = array_shift($array_to_store_data);
	ksort($array_to_store_data);
//	print_r($array_to_store_data);
//	exit(0);
	$total_female= 0;
	$total_male = 0;
	$total = 0;
	$mask = "/ %5s / %5s / %5s / %5s /\n";
	$line ="/ --- / --- / --- /\n";
	printf($mask, 'District', 'female','male','total');
	echo $line;
//	echo $mask.'District'.' '.'female'.' '.'male'.' '.'total';
	foreach ($array_to_store_data as $key => $value) {
		$Total=$value['female']+$value['male'];
//		echo $key."\n";

		echo "/ ".$key ." / "." ".$value['female'].' / '.' '. $value['male'].' / '." " .$Total.' / '."\n";
//		echo array_sum($value['female']);
		$total_female += $value['female'];
		$total_male += $value['male'];
		$total += $Total;


	}
	echo '/ '."total".' / '.' '.$total_female.' / '.' '.$total_male.' / '.' '.$total.' / ';
//	echo $total;
	return true;
}
echo "\n Sorry File (example.log) Not found \n";