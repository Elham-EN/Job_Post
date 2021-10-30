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
    <h1>Job Vacancy Posting System</h1>
    <form action="searchjobprocess.php" method="GET">
        <label for="title">Job Title:</label>
        <input class="search_input" type="text" name="job_title">
        <button type="submit">Search</button>
        <br />
        <p><a href="./index.php">Return to Home Page</a></p>
    </form>
</body>
</html>