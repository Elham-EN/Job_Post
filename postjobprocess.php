<?php  $form_validated = true ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/postjobform_style.css">
    <meta name="description" content="COS30020 Assignment 1" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Elham" />
    <title>Document</title>
</head>
<body>
    <h1>Process Post Job Page</h1>
<?php
     $postion_id_array = array();
     $id_regex = '/^[A-Z]{1}\d{4}$/';
     //Check if position id data exist 
     if (isset($_POST['pos_id_input']) && empty($_POST['pos_id_input'])) {
        echo "<p class=\"bg_danger\"> ID is required </p>";
        $form_validated = false;
     //Check if position id match the correct format 
     } else if (isset($_POST['pos_id_input']) && !preg_match($id_regex, $_POST['pos_id_input'])) {
        echo "<p class=\"bg_danger_2\">
                It must start with an uppercase letter than followed by 4 digits.
              </p>";
        $form_validated = false;
    } else {
        $position_id = $_POST['pos_id_input'];
        $postion_id_array[] = $position_id;
    }

    $title_regex = '/^[\.a-zA-Z0-9,!_ ]{1,20}-*$/';
    if (isset($_POST['title_input']) && empty($_POST['title_input'])) {
        echo "<p class=\"bg_danger\"> Title is required </p>";     
        $form_validated = false;       
    } else if (isset($_POST['title_input']) && !preg_match($title_regex, $_POST['title_input'])) {
        echo "<p class=\"bg_danger_2\">
                The title can only contain a maximum of 20 alphanumeric characters including 
                spaces, comma, period (full stop), and exclamation point. Other characters 
                or symbols are not allowed
              </p>";
    } 
    
    $desc_regex = '/^((.|\n|\r)){1,250}$/';
    if (isset($_POST['desc_input']) && empty($_POST['desc_input'])) {
        echo "<p class=\"bg_danger\"> Description is required </p>";
        $form_validated = false;
    } else if (isset($_POST['desc_input']) && !preg_match($desc_regex, $_POST['desc_input'])) {
        echo "<p class=\"bg_danger\"> Description only accept 250 characters </p>";
        $form_validated = false;
    } 

    $date_regex = '/^([0-2]\d|3[0-1])\/(0\d|1[0-2])\/(19|20)\d{2}$/';
    if (isset($_POST['date_input']) && empty($_POST['date_input'])) {
        echo "<p class=\"bg_danger\"> date is required </p>";
        $form_validated = false;
    } else if (isset($_POST['desc_input']) && !preg_match($date_regex, $_POST['date_input'])) {
        echo "<p class=\"bg_danger\"> Date must be in the correct format dd/mm/yy </p>";
        $form_validated = false;
    }

    if (empty($_POST['pos_input'])) {
        echo "<p class=\"bg_danger\"> need to select position </p>";
        $form_validated = false;
    }

    if (empty($_POST['cont_input'])) {
        echo "<p class=\"bg_danger\"> need to select a contract </p>";
        $form_validated = false;
    }

    if (empty($_POST['applications'])) {
        echo "<p class=\"bg_danger\"> need to select at least one option on how to send the application </p>";
        $form_validated = false;
    } else {
        $application_sent = implode(",",  $_POST['applications']);
    }

    if (strcmp(stripslashes($_POST['location']), "---") == 0) {
        echo "<p class=\"bg_danger\"> need to select a location </p>";
        $form_validated = false;
    }

    

    //echo $form_validated ? "True" : "false";
 
    umask(0007);
    $dir = "../../data/jobposts";
    if(!is_dir($dir)) {
        mkdir($dir, 02770);
    }
    //If the fields are supllied with vaild data, the form_validated is true
    if ($form_validated) {
        //$filename = __DIR__ . '/jobpost.txt';
        $filename = "../../data/jobposts/jobs.txt";
        $title = $_POST['title_input'];
        $desc = $_POST['desc_input'];
        $date = $_POST['date_input'];
        $position_radio = $_POST['pos_input'];
        $contract_radio = $_POST['cont_input'];
        $location = $_POST['location'];

        $jobpost_id_arr = array();
        if (file_exists($filename)) {
            $handle = fopen($filename, "r");
            while (!feof($handle)) {
                $jobpost_data = fgets($handle);
                if ($jobpost_data != "") {
                    $data = explode("\t", $jobpost_data);
                    $jobpost_id_arr[] = $data[0];
                }
            }
            fclose($handle);
            $new_jobpost_data = !in_array($position_id, $jobpost_id_arr);
        } else {
            $new_jobpost_data = true;
        }
        if ($new_jobpost_data) {
            $handle = fopen($filename, "a+");
            $data = $position_id . "\t" . $title . "\t" . $desc . "\t" . $date . "\t" . $position_radio . "\t" .
                        $contract_radio . "\t" . $application_sent . "\t" . $location . "\n";
            fwrite($handle, $data);
            fclose($handle);
            echo "<p class=\"bg_success\">Your job vacancy successfully stored in the file</p>";
            echo '<p><a href="./index.php">Return to Home Page</a></p>';
            echo '<p><a href="./postjobform.php">Return to post Job vacancy </a></p>';
        } else {
            echo "<p>Job Id already exist</p>";
            echo '<p><a href="./index.php">Return to Home Page</a></p>';
            echo '<p><a href="./postjobform.php">Return to Job vacancy </a></p>';
        }
	} else {
        echo "<p>Please go back to the form and provide valid data or go back to the home page </p>";
        echo '<p><a href="./index.php">Return to Home Page</a></p>';
        echo '<p><a href="./postjobform.php">Return to post Job vacancy </a></p>';
    }

    

    function chk_positionID_unique() {

    }
?> 

</body>
</html>