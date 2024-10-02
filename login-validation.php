<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // Loginname und Passwortabfrage
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);

                // Bei Passwortübereinstimmungung und Account aktiviert -> Login

                if($user_data['password'] === $password && $user_data['status'] === "activated")
                {
                    $_SESSION['id'] = $user_data['id'];
                    $_SESSION['role'] = $user_data['role'];
                    header("Location: user.php");
                    die;
                }
            }
        }

        echo "Name/Passwort falsch oder Konto nicht aktiviert";
    }else
    {
        echo "Name/Passwort falsch";
    }
}







