<?php

// ADMIN BACK-END MANAGE USERS

function displayUsers($result)
{

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        echo '<tr id="row' . $row['id'] . '">';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td><button class="btn btn-danger" type="submit" value="' . $row['id'] . '">Delete</button></td></tr>';
        echo '</tr>';
    }


}//end of display function

function EditUsers($result)
{


    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td><a href="update_users.php?id=' . $row['id'] . '">Update</a></td>';
        echo '</tr>';
    }

}//end of display function


function validateAndUpdateUser($db, $parsed_id)
{
     if (!empty($_POST)) {

        $validator = new GUMP();

        $_POST = $validator->sanitize($_POST);


        $validator->validation_rules(array(
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ));


        $validator->filter_rules(array(
            'name' => 'trim',
            'username' => 'trim',
            'email' => 'trim'
        ));


        $validated_data = $validator->run($_POST);

        if ($validated_data === false) {
            foreach ($validator->get_errors_array() as $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
        } else {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // query
            $sql = "UPDATE users SET name='$name', username='$username', email='$email', password='$password' WHERE id='$parsed_id'";

                 //execute the query
                        $db->query($sql);
                        Redirect::to('manageusers.php');
                    }
                if (empty($error)) {
                    // displays a success message
                    // echo '<div class="alert alert-success" role="alert">You\'ve successfully updated a user</div>';
                }
            }


        }
