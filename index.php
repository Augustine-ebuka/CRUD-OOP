<?php
require_once('./include/connect_db.php');
$db = new users_operation();
echo $db->dispaly_message();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <div class="container container-fluid">
        <div class="row">
            <div class="col-lg-4 m-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2>Register New Users</h2>
                       <?php echo $db->filename?>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-title">
                                <?php $db->insert_users(); ?>
                            </div>

                            <input type="text" class="form-control mb-3" name="firstname" required="required" placeholder="firstname">
                            <input type="text" class="form-control mb-3" name="lastname" required="required" placeholder="lasttname">
                            <input type="email" class="form-control mb-3" name="email" required="required" placeholder="Email">
                            <input type="number" class="form-control mb-3" name="phonenumber" required="required" placeholder="phone number">
                            <input type="file" class="form-control mb-3" name="image" required="required" placeholder="photo">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" name="submit">save</button>
                        <div id="view">
                            <a href="view.php" class="btn btn-primary">View</a>

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>