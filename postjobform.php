
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="COS30020 Assignment 1" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Elham" />
    <link rel="stylesheet" href="./styles/postjobform_style.css">
    <title>Post job form</title>
</head>
<body>
    <h1>Job Vacancy Posting System</h1>
    <form  method="POST" action="./postjobprocess.php" >
       <div class="div1">
           <label for="pos_id_input">Position ID:</label>
           <input type="text" name="pos_id_input" >
       </div>
       <div class="div2">
           <label for="title_input">Title: </label>
           <input type="text" name="title_input" >
       </div>
       <div class="div3">
           <label for="desc_input">Description</label>
           <textarea name="desc_input" maxlength="250"></textarea>
       </div>
       <div class="div4">
           <?php $date = date("d/m/Y");?>
           <label for="date_input">Closing Date:</label>
           <input type="text" name="date_input" value="<?php echo $date?>">
       </div>
       <div class="div5">
           <span>Position:</span>
           <input type="radio" name="pos_input" value="full-time" />
           <label for="pos">Full Time</label>
           <input type="radio" name="pos_input" value="part-time" />
           <label for="pos">Part Time</label>  
       </div>
       <div class="div6">

           <span>Contract:</span>
           <input type="radio" name="cont_input" value="on-going" />
           <label for="cont_input">On-going</label>
           <input type="radio" name="cont_input" value="fixed-term" />  
           <label for="const_input">Fixed Term</label>
       </div>
       <div class="div7">
       <span>Application by:</span>
           <input type="checkbox" name="applications[]" value="post" />
           <label for="app">POST</label>
           <input type="checkbox" name="applications[]" value="mail" />
           <label for=app">Mail</label>
       </div>
       <div class="div8">
            <label for="cars">Location:</label>
            <select name="location" />
                <option selected>---</option>
                <option value="atc">ATC</option>
                <option value="nsw">NSW</option>
                <option value="nt">NT</option>
                <option value="qld">QLD</option>
                <option value="sa">SA</option>
                <option value="tas">TAS</option>
                <option value="vic">VIC</option>
                <option value="wa">WA</option>
            </select>
	   </div>
       <button type="submit">Post</button>
       <button type="reset">Reset</button>
       <p>All fields are required. <a href="./index.php">Return to Home Page</a></p>
    </form>
</body>
</html>

