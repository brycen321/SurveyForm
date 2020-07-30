<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Results</title>
</head>
<body>
    <header>
        <nav>
            <h1 class="title">Form Submitted!</h1>
        </nav>
        <p class="description">Thank you for submitting your answers!</p>
    </header>

    <?php
        $name = $_POST["name"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $occupation = $_POST["occupation"];
        $frequency = $_POST["frequency"];
        $hours = $_POST["hours"];
        $genres = $_POST["genres"];
        $genrestring = implode(', ', $genres);
        $comments = $_POST["comments"];
    ?>

    <section class="container">
        <div class="result-header">Your survey results will be shown below</div>
        <div class="result-subheader">Click "Back to Form" to go back to the form or "Save Results" if you want to export your results!</div>
        <div class="result-text">Name: <?php echo $name?></div>
        <div class="result-text">Email: <?php echo $email?></div>
        <div class="result-text">Age: <?php echo $age?></div>
        <div class="result-text">Occupation: <?php echo $occupation?></div>
        <div class="result-text">How often do you play games?: <?php echo $frequency?></div>
        <div class="result-text">How many hours do you play in a day?: <?php echo $hours?></div>
        <div class="result-text">What genres do you play?: <?php echo $genrestring?></div>
        <div class="result-text">Comments: <?php echo $comments?></div>
        <div class="buttons">     
            <a class="button-result" onclick="return confirm('Are you sure you want to go back? (This will return you to an empty form)');" href="/">Back to Form</a>
            <a class="button-result" href="javascript:exportTabletoExcel(tableId)">Save Results</a>
        </div>
    </section>

    <!-- Server integration: -->

    <?php
      $host = "localhost:8889";
      $dbusername = "root";
      $dbpassword = "root";
      $dbname = "survey_form";

      $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
      if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
      }else{
        $sql = "INSERT INTO survey_form_data (Name, Email, Age, Occupation, Frequency, Hours, Genres, Comments)
        values ('$name','$email','$age','$occupation','$frequency','$hours','$genrestring','$comments')";
        if ($conn->query($sql)){
            #echo "New record is inserted sucessfully";
        }else{
            #echo "Error: ". $sql ."
            #". $conn->error;
        }
        $conn->close();
      }
    ?>

      <!-- Hidden table for .xls export -->

    <table id="tableData">
        <tr>
            <tbody style="display:none">
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Occupation</th>
            <th>How often do you play games?</th>
            <th>How many hours do you play in a day?</th>
            <th>What genres do you play?</th>
            <th>Comments</th>
        </tr>
        <tr>
            <td><?php echo $name?></td>
            <td><?php echo $email?></td>
            <td><?php echo $age?></td>
            <td><?php echo $occupation?></td>
            <td><?php echo $frequency?></td>
            <td><?php echo $hours?></td>
            <td><?php echo $genrestring?></td>
            <td><?php echo $comments?></td>
        </tr>
    </table>


    
</body>
</html>
