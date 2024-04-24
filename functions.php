<?php
	//filtrowanie nazwy pliku
	
	function filter_filename($name) {
    // remove illegal file system characters https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
    $name = str_replace(array_merge(
        array_map('chr', range(0, 31)),
        array('<', '>', ':', '"', '/', '\\', '|', '?', '*')
    ), '', $name);
    // maximise filename length to 255 bytes http://serverfault.com/a/9548/44086
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $name= mb_strcut(pathinfo($name, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($name)) . ($ext ? '.' . $ext : '');
    return $name;
}

	//usuwanie katalogu
	function deleteDirectory($dir) {
		if (!file_exists($dir)) {
			return true;
		}
		if (!is_dir($dir)) {
			return unlink($dir);
		}
		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..') {
				continue;
			}
			if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
				return false;
			}
		}
		return rmdir($dir);
}

	//pobeiranie daty
	
	$First = date("D");
	$Second = date("D", strtotime("+1 day"));
	$Third = date("D", strtotime("+2 day"));
	$Fourth = date("D", strtotime("+3 day"));
	$Fifth = date("D", strtotime("+4 day"));
	$Sixth = date("D", strtotime("+5 day"));
	$Seventh = date("D", strtotime("+6 day"));
	function dni($day){
		switch($day){
			case "Mon":
				$dzien = "Pon";
				return $dzien;
				break;
			case "Tue":
				$dzien = "Wt";
				return $dzien;
				break;
			case "Wed":
				$dzien = "Śr";
				return $dzien;
				break;
			case "Thu":
				$dzien = "Czw";
				return $dzien;
				break;
			case "Fri":
				$dzien = "Pt";
				return $dzien;
				break;
			case "Sat":
				$dzien = "Sob";
				return $dzien;
				break;
			case "Sun":
				$dzien = "Ndz";
				return $dzien;
				break;					
		}
	}
		
//functions


?>