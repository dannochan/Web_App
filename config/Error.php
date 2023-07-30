<?php

/**
 * Throws an ErrorException.
 * 
 * @param string $message			The message which should be send with this exception.
 * @param int $severity				The severity level of the exception.
 * @param string $filename			The filename, where the exception should be thrown.
 * @param int $linenr				The line where the exception should be thrown.
 * @param exception $prev_exception	The exception which were catched before.
 * 
 */
function exception_handler($message, $severity, $filename, $linenr, $prev_exception)
{
	if ($prev_exception != NULL) {
		throw new ErrorException($message, 0, $severity, $filename, $linenr, $prev_exception);
	} else {
		throw new ErrorException($message, 0, $severity, $filename, $linenr);
	}
}

/**
 * This functions prints the HTML-Code for an alert.
 * 
 * @param string $message	The message which should be printed by the alert.
 * @param bool $result		Checks if the alert should be positive or negative.
 */
function print_result($message, $result)
{
	if ($result) {
		print '<div class="alert alert-success text-center" role="alert"><b>' . $message . '</b></div>';
	} else {
		print '<div class="alert alert-danger text-center" role="alert"><b>' . $message . '</b></div>';
	}
}

function print_error_popup($title, $text)
{

	echo '<script>
			setTimeout(function() {
				swal.fire({
					title: "' . $title . '",
					text: "' . $text . '",
					icon: "error",
					showCloseButton: true,
					timer: 5000,
					timerProgressBar: true
				}, );
			}, 300);
		</script>';
}

function validateInteger($value)
{

	$result = filter_var(intval($value), FILTER_VALIDATE_INT);
	if ($result == true) {
		return $result;
	} else {
		throw new InvalidArgumentException('Eingabe ist keine positive Zahl. ' . $value);
	}
}

function validateFloat($value)
{

	$result = filter_var(floatval($value), FILTER_VALIDATE_FLOAT);
	if ($result == true) {
		return $result;
	} else {
		throw new InvalidArgumentException('Die Noten wird nicht richtig eingegeben. ' . $value);
	}
}

function validateInput($input)
{
	if (!is_string($input) || intval($input)) {
		throw new InvalidArgumentException('Eingabe ist nicht gültig.' . $input);
	}
	$result = trim(htmlspecialchars($input));
	return $result;
}

function validateURL($url)
{
	$result = filter_var($url, FILTER_VALIDATE_URL);
	if ($result != true) {
		throw new InvalidArgumentException('Der eingegebene Link ist nicht gültig' . $url);
	}
}

function validateImage($imageFile){

	$fileName=$imageFile['name'];
	$fileSize=$imageFile['size'];
	$fileError=$imageFile['error'];

	$fileExt=explode('.', $fileName);
	$fileActualExt=strtolower(end($fileExt));
	$allowedExts = array("gif", "jpeg", "jpg", "png");


	if(!in_array($fileActualExt, $allowedExts)){
		throw new Exception("Das Format des Image wird nicht unterstützt werden : ".$fileName);
	}
	if($fileError!==0){
		throw new Exception("Das Image enthältet Fehler : ".$fileName);
	}
	if($fileSize>1000000){
		throw new Exception("Das Image ist zu groß : ".$fileName);
	}

}
