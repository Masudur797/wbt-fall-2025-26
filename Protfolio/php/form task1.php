<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Name validation
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        // Email validation
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Website validation
        if (empty($_POST["website"])) {
            $website = "";
        } else {
            $website = test_input($_POST["website"]);
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $websiteErr = "Invalid URL";
            }
        }

        // Comment (optional)
        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        // Gender validation
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>PHP Form Validation Example</h2>
    <p><span class="error">* required field</span></p>

    <!-- Corrected action attribute -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        Name:
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>

        E-mail:
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>

        Website:
        <input type="text" name="website" value="<?php echo $website; ?>">
        <span class="error"><?php echo $websiteErr; ?></span>
        <br><br>

        Comment:
        <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
        <br><br>

        Gender:
        <input type="radio" name="gender" value="female" <?php if ($gender == "female") echo "checked"; ?>> Female
        <input type="radio" name="gender" value="male" <?php if ($gender == "male") echo "checked"; ?>> Male
        <input type="radio" name="gender" value="other" <?php if ($gender == "other") echo "checked"; ?>> Other
        <span class="error">* <?php echo $genderErr; ?></span>
        <br><br>

        <input type="submit" name="submit" value="Submit">

    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $name . "<br>";
    echo $email . "<br>";
    echo $website . "<br>";
    echo $comment . "<br>";
    echo $gender . "<br>";
    ?>

</body>

</html>
