<?php

$filename = $_FILES["file"]['name'];
$symbol = $_POST['symbol'];
$location = "upload/".$filename;
$errors = [];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if($file_size > 1000) {
  $errors['message'][] = "File maximum size must be lower then 1kb, you file's size is high";
}

if($file_type != "text/plain" && $ext !== 'txt') {
  $errors['message'][] = "File type must be text";
}

if(count($errors) == 0) {
  if(!is_dir('upload')) {
    mkdir("upload"); // for linux type OS mkdir('upload', 0777) better 0755
  }
  try {
    move_uploaded_file($_FILES['file']['tmp_name'], $location);

    $file_content = file_get_contents($location);
    $delimiter = empty($symbol) ? '.' : $symbol;
    $splited_array = explode("$delimiter", $file_content);

    $splited_array = array_map(fn ($value, $keys) => [strlen($value) => $value], $splited_array, array_keys($splited_array));

    print(json_encode(["success" => true, "array" => $splited_array]));  
  } catch (Exception $e) {
    print(json_encode(["success" => false]));   
  }

} else {
  print(json_encode(["errors" => $errors]));
}
