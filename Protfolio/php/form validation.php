<?php


//                                         SUMMARY             
//This is a 6-stepida valted form where each field is submitted using a separate button.
//Each field is validated individually, and an error message is shown if the input is not correct.
//If the input is valid, the cleaned data is stored in its respective variable.


$nameErr = $emailErr = $dobErr = $genderErr = $degreeErr = $bloodErr = "";
$name = $email = $day = $month = $year = $gender = $blood = "";
$degree = [];


function test_input($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST["submit_name"])) {

        if (empty($_POST["name"])) {
            $nameErr = "Name cannot be empty";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z][a-zA-Z. -]* [a-zA-Z. -]+$/", $name)) {
                $nameErr = "Must contain 2 words, start with letter, only letters/dash/period allowed";
            }
        }
    }


    if (isset($_POST["submit_email"])) {

        if (empty($_POST["email"])) {
            $emailErr = "Email cannot be empty";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
    }

    
    if (isset($_POST["submit_dob"])) {

        $day = $_POST["day"];
        $month = $_POST["month"];
        $year = $_POST["year"];

        if (empty($day) || empty($month) || empty($year)) {
            $dobErr = "Date of birth cannot be empty";
        } elseif ($day < 1 || $day > 31 || $month < 1 || $month > 12 || $year < 1953 || $year > 1998) {
            $dobErr = "Invalid date! (dd:1-31, mm:1-12, yyyy:1953-1998)";
        }
    }

    
    if (isset($_POST["submit_gender"])) {

        if (empty($_POST["gender"])) {
            $genderErr = "Select at least one gender";
        } else {
            $gender = $_POST["gender"];
        }
    }

    
    if (isset($_POST["submit_degree"])) {

        if (empty($_POST["degree"])) {
            $degreeErr = "Select at least one degree";
        } else {
            $degree = $_POST["degree"];
        }
    }

    
    if (isset($_POST["submit_blood"])) {

        if (empty($_POST["blood"])) {
            $bloodErr = "Blood group must be selected";
        } else {
            $blood = $_POST["blood"];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form validation with Submit Buttons</title>
</head>
<body>

<h2>STUDENT INFORMATION FORM</h2>

<form method="post" action="">


<fieldset style="width:350px;">
    <legend>NAME</legend>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <br><br>
    <span style="color:red;"><?php echo $nameErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</fieldset>
<br>


<fieldset style="width:350px;">
    <legend>EMAIL</legend>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <br><br>
    <span style="color:red;"><?php echo $emailErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</fieldset>
<br>


<fieldset style="width:350px;">
    <legend>DATE OF BIRTH</legend>
    Day: <input type="number" name="day" min="1" max="31" value="<?php echo $day; ?>">
    Month: <input type="number" name="month" min="1" max="12" value="<?php echo $month; ?>">
    Year: <input type="number" name="year" min="1953" max="1998" value="<?php echo $year; ?>">
    <br><br>
    <span style="color:red;"><?php echo $dobErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</fieldset>
<br>


<fieldset style="width:350px;">
    <legend>GENDER</legend>
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Other"> Other
    <br><br>
    <span style="color:red;"><?php echo $genderErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</fieldset>
<br>


<fieldset style="width:350px;">
    <legend>DEGREE</legend>
    <input type="checkbox" name="degree[]" value="SSC"> SSC
    <input type="checkbox" name="degree[]" value="HSC"> HSC
    <input type="checkbox" name="degree[]" value="BSC"> BSC
    <input type="checkbox" name="degree[]" value="MSC"> MSC
    <br><br>
    <span style="color:red;"><?php echo $degreeErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</fieldset>
<br>


<fieldset style="width:350px;">
    <legend>BLOOD GROUP</legend>
    <select name="blood">
        <option value="">-- Select Blood Group --</option>
        <option>A+</option><option>A-</option>
        <option>B+</option><option>B-</option>
        <option>AB+</option><option>AB-</option>
        <option>O+</option><option>O-</option>
    </select>
    <br><br>
    <span style="color:red;"><?php echo $bloodErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</fieldset>

</form>


</body>
</html>
