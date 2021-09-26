<?php
session_start();
require_once('./include/connect_db.php');
$db = new users_operation();
$id = $_GET['u_id'];
$result = $db->edit_user($id);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit users details</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-4 m-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2>Edit</h2>
                    </div>
                    <div class="card-body">
                        <?php $db->update() ?>
                        
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                            <input type="text" class="form-control mb-3" name="firstname" value="<?php echo $data['firstname'] ?>" placeholder="firstname" required="required">
                            <input type="text" class="form-control mb-3" name="lastname" placeholder="lasttname" value="<?php echo $data['lastname'] ?>" required="required">
                            <input type="email" class="form-control mb-3" name="email" placeholder="Email" value="<?php echo $data['email'] ?>" required="required">
                            <input type="number" class="form-control mb-3" name="phonenumber" placeholder="phone number" value="<?php echo $data['phonenumber'] ?>" required="required">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" name="update">update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>