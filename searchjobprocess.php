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
    <h1>Job Vacancy Information</h1>
    <?php
        if (!(isset($_GET['job_title']) && empty($_GET['job_title']))) {
            $job_title = $_GET['job_title'];
            //echo $job_title;
            //$filename = __DIR__ . '/jobpost.txt';
            $filename = "../../data/jobposts/jobs.txt";
            $allData = array();
            if (file_exists($filename)) {
                $handle = fopen($filename, "r");
                while (!feof($handle)) {
                    $onedata = fgets($handle);
                    if ($onedata != "") {
                        $data = explode("\t", $onedata);
                        $allData[] = $data;
                        $itemdata[] = $data[1];
                    }
                }
                fclose($handle);
                $filter_array = array();
                for ($i = 0; $i < count($allData); $i++) {
                    if (strcmp(strtolower($job_title), strtolower($itemdata[$i]))  == 0) {
                        //echo " ". strtolower($itemdata[$i]) ." ";
                       $filter_array[] = $allData[$i];
                    } 
                }

                if ($filter_array) {
                    foreach ($filter_array as $array) {
                        echo "<pre>";
                        //print_r($array);
                        echo "</pre>";
                        str_display($array);
                    }
                    echo '<p><a href="./index.php">Return to Home Page</a></p>';
                    echo '<p><a href="./postjobform.php">Search for another Job vacancy </a></p>';
                } else {
                    echo "<p>Cannot find what you are looking for</p>";
                    echo '<p><a href="./index.php">Return to Home Page</a></p>';
                    echo '<p><a href="./postjobform.php">Go back to Job vacancy </a></p>';
                }
                
            } else {
                echo "file does not exist";
            }
        } else {
            echo "<p class=\"bg_danger\"> must enter job title </p>";
        }

        function str_display($arrays) {
            $strDisplyJob = "<p>" . "Title: " . $arrays[1] . "</p><p>" . "Description: " . 
            $arrays[2] . "</p><p>" . "Closing Date: " . $arrays[3] . "</p><p>" .
                "Position: " . $arrays[4] . " - " . $arrays[5] . "</p><p>" . 
                "Application by: " . $arrays[6] . "</p><p>" . "Location: " . $arrays[7] . "</p><hr>";
            echo $strDisplyJob;

        }
    ?>
</body>
</html>