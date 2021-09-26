<?php
session_start();
require_once('./include/connect_db.php');
$db = new users_operation();
$result = $db->dispaly_userinfo();
//$id = $_GET['u_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card">
                    <div class="card-header">
                        <h3 style="text-align:center;">User Information</h3>
                    </div>
                    <div class="table-title">

                        <?php

                        $db->dispaly_message();
                        $db->dispaly_message();
                        ?>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <td style="width: 10%">#Id</td>
                                    <td style="width: 20%">First name</td>
                                    <td style="width: 20%">last name</td>
                                    <td style="width: 20%">Email</td>
                                    <td style="width: 20%">phone number</td>
                                    <td style="width: 10%" colspan="3">Operation</td>
                                </tr>
                            </thead>
                            <tr>
                                <?php if (mysqli_num_rows($result) == 0) {
                                    echo "<h3 style='text-align:center; color: red;'>No Record Stored</h3>";
                                    # code...
                                } else {
                                    while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                        <td><?php echo $data['id'];  ?></td>
                                        <td><?php echo ucfirst($data['firstname'])  ?></td>
                                        <td><?php echo  ucfirst($data['lastname'])   ?></td>
                                        <td><?php echo $data['email'];   ?></td>
                                        <td><?php echo $data['phonenumber']; ?></td>
                                        <td><a href="edit.php?u_id=<?php echo  $data['id'] ?>" class="btn btn-success">Edit</a> </td>
                                        <td><a href="delete.php?u_id=<?php echo $data['id'] ?>" class="btn btn-danger">Del</a> </td>
                                        <td><a href="personal.php?u_id=<?php echo $data['id'] ?>" class="btn btn-primary">view</a> </td>
                            </tr>

                    <?php
                                    }
                                }

                    ?>
                        </table>
                        <a href="index.php" class="btn btn-primary">Add users</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>