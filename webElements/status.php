<?php

//relative pfade für links in apply.php
$transcript = 'uploads/files/'.$_SESSION['lastname'].'_TranscriptOfRecords_'.$_SESSION['matriculation'].'.pdf';
$visa = 'uploads/files/'.$_SESSION['lastname'].'_VisaInformation_'.$_SESSION['matriculation'].'.pdf';
$lang = 'uploads/files/'.$_SESSION['lastname'].'_LanguageTest_'.$_SESSION['matriculation'].'.pdf';
$motivation = 'uploads/files/'.$_SESSION['lastname'].'_MotivationLetter_'.$_SESSION['matriculation'].'.pdf';
$pass = 'uploads/files/'.$_SESSION['lastname'].'_PassInformation_'.$_SESSION['matriculation'].'.pdf';
$photo = 'uploads/files/'.$_SESSION['lastname'].'_PassportPhoto_'.$_SESSION['matriculation'].'.pdf';

//wert von bewerbungsstatus initial 0
$value = "0";

//addiert 100/7 je benötigtem hochgeladenen dokument
if(file_exists($transcript)) { 
    $value = $value + 100/7;
} else { 
    $value = $value + 0;
};
if(file_exists($visa)) { 
    $value = $value + 100/7;
} else { 
    $value = $value + 0;
};
if(file_exists($lang)) { 
    $value = $value + 100/7;
} else { 
    $value = $value + 0;
};
if(file_exists($motivation)) { 
    $value = $value + 100/7;
} else { 
    $value = $value + 0;
};
if(file_exists($pass)) { 
    $value = $value + 100/7;
} else { 
    $value = $value + 0;
};
if(file_exists($photo)) { 
    $value = $value + 100/7;
} else { 
    $value = $value + 0;
};
if($result4['MatriculationNumber']) {
    $value = $value + 100/7;
} else {
    $value = $value + 0;
};

//wert ohne dezimalstelle runden
$value = number_format ($value, 0);

?>
