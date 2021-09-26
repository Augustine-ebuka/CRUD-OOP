<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title>Document</title>
</head>

<?php
session_start();
require_once('./include/connect_db.php');
$db = new users_operation();
$id = $_GET['u_id'];
$result = $db->personal($id);
$data = mysqli_fetch_assoc($result);
$image = $data['photo'];
?>

<body>
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 style="text-align: center;">view personal information</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="images/<?php echo $image; ?>" class="img-responsive m-auto" style="width:150px;height:150px">
                                    <form enctype="multipart/form-data" class="form-inline" role="form" method="POST">
                                        <input type="file" class="form-control mt-3" name="profile_pic">
                                        <button class="btn btn-primary  mt-3" name="update">Change pic</button>
                                        <?php $db->update_imaage("update", "profile_pic", $id) ?>
                                    </form>
                                </div>
                                <div class="col-md-4 m-auto">
                                    <label for="name">Name:</label>
                                    <h6><?php echo ucfirst(strtolower($data['firstname'] . " " . $data['lastname'])); ?></h6>
                                    <label for="phone">Phone Number:</label>
                                    <h6><?php echo $data['phonenumber']; ?></h6>
                                    <label for="date">date registerd:</label>
                                    <h6><?php echo $data['data_reg'] ?></h6>
                                    <label for="date">Email:</label>
                                    <h6><?php echo $data['email'] ?></h6>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="view.php" class="btn btn-primary">home</a>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


</body>

</html>
<script type="text/javascript">
    window.onload();
</script>