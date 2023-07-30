<?php
    /**
     * This function gets all applications which were accepted and creates the start date of this semester (01.04 for the
     * Summer semester an 01.10 for the Winter semester).
     */
    function proof_accepted_applications(){
        $db = db_connection();
        $statement = $db->prepare("SELECT Student.MatriculationNumber, InitialRequest.StartSemester, InitialRequest.StartYear, 
                                InitialRequest.Duration 
                                FROM Student JOIN InitialRequest ON Student.MatriculationNumber = InitialRequest.MatriculationNumber 
                                JOIN Applications ON Student.MatriculationNumber = Applications.MatriculationNumber 
                                WHERE Applications.Status = 'Angenommen' AND Student.Completed = '0'");
        $statement->execute();

        while ($row = $statement->fetch()){
            $semester_name = $row["StartSemester"];
            $year = $row["StartYear"];
            $duration = $row["Duration"];
            $student_id = $row["MatriculationNumber"];
            if ($semester_name === "Sommersemester"){
                $semester_date = new DateTime("04/01/".$year);
            }else{
                $semester_date = new DateTime("10/01/".$year);
            }
             if (proof_if_completed($semester_date, $duration)){
                 set_application_completed($student_id);
             }
        }
    }

    /**
     * This function proofs if a student has completed his abroad semester.
     * 
     * @param date $date:           The date where the student starts his abroad semester.
     * @param string $duration:     The duration of the abroad semester.
     * @return bool:                True - if the student completed his abroad semester. False - If the student 
     *                              did not completed his abroad semester.
     */
    function proof_if_completed($date, $duration){
        $today = getdate();
        if ($today["mon"] < 10){
            $today_date = new DateTime("0".$today["mon"]."/".$today["mday"]."/".$today["year"]);
        }else{
            $today_date = new DateTime($today["mon"]."/".$today["mday"]."/".$today["year"]);
        }
        if ($duration === "1"){
            $completed_date = $date->modify("+4 month");
        }else{
            $completed_date = $date->modify("+1 year");
        }
        if ($today_date > $completed_date){
            return True;
        }
        return False;
    }

    /**
     * This function sets the boolean in the database for completion to true.
     * 
     * @param int $student_id:  The id of the student who completed his abroad semester.
     */
    function set_application_completed($student_id){
        $db = db_connection();
        $statement = $db->prepare("UPDATE `Student` SET `Completed` = '1' WHERE `Student`.`MatriculationNumber` = ?;");
        $statement->execute(array($student_id));
    }
?>