<?php
if ($_SERVER ["REQUEST_METHOD"] === "POST") {
	if (isset($_FILES['images'])) {
		$errors = [];
		$path = "uploads/images/";
		$extensions = ["png"];
		$all_files = count ($_FILES ["images"]["tmp_name"]);
		for ($i = 0; $i < $all_files; $i++) {
			$file_name = $_FILES['images']['name'][$i];
			$file_tmp = $_FILES['images']['tmp_name'][$i];
			$file_type = $_FILES['images']['type'][$i];
			$file_size = $_FILES['images']['size'][$i];
			$file_ext = strtolower(end(explode('.', $_FILES['images']['name'][$i])));

			$file = $path . $file_name;
			
			if (!in_array($file_ext, $extensions)) {
				$errors[] = 'Dateityp nicht erlaubt: ' . $file_name . ' ' . $file_type;
			}

			if ($file_size > 2097152) {
				$errors[] = 'Datei zu groß: ' . $file_name . ' ' . $file_type;
			}
			
			if (empty($errors)) {
				$real_path = "../../".$file;
				move_uploaded_file($file_tmp, $real_path);
	
			}
		}
		
	}
}
?>