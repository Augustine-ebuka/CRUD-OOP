<?php
require_once('connect_db.php');
  $fromCon = new connectdb();
//this method insert user into the database
class users_operation extends connectdb
{
    public $filename, $tmpname, $filesize, $filerror, $filetype, $filelocation, $extensiontolower, $new_name;
        public function insert_users()
        {
            global $fromCon;
        
            if(isset($_POST['submit'])) 
            {
                
                $firstname = $fromCon->auto($_POST['firstname']);
                $lastname =  $fromCon->auto($_POST['lastname']);
                $email =  $fromCon->auto($_POST['email']);
                $phonenumber = $fromCon->auto($_POST['phonenumber']);
                $filename = $_FILES['image']['name'];
                $tmpname =  $_FILES["image"]['tmp_name'];
                $filesize = $_FILES["image"]['size'];
                $filerror = $_FILES["image"]['error'];
                $seperate=explode(".",$filename);
                $get_ext=strtolower(end($seperate));
                $acceptable_ext=array("jpeg","jpg","png");
                if (in_array($get_ext,$acceptable_ext)) {
                    if ($filesize<50000000) {
                        if ($filerror==0) {
                            $new_name=uniqid("",true).".".$filename;
                            $location='images/'.$new_name;
                            if ($this->save_users($firstname, $lastname, $email, $phonenumber, $new_name) AND move_uploaded_file($tmpname, $location)) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    <span class='sr-only'>Close</span>
                                  </button>
                                 <strong>data save successfully!</strong>
                                </div>";
                             }else{
                            echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                          <span aria-hidden='true'>&times;</span>
                                          <span class='sr-only'>Close</span>
                                    </button>
                                    <strong>unable to save!</strong>
                                </div>";  
                            }

                         }
                         else{
                             echo"error";
                         }
                    }else{
                        echo "error";
                    }
                }else{
                    echo"eroror";
                }
            }
        }
        public function save_users($a,$b,$c,$d,$f)
        {
            global $fromCon;
        
            $enter = "insert into user (firstname,lastname,email,phonenumber,photo) VALUES('$a','$b','$c','$d','$f')";
            $qeury = mysqli_query($fromCon->connection, $enter);
            return $qeury;
        }
        //this method is use to disaplay user into the table
    public function dispaly_userinfo()
    {
        global $fromCon;

        $pick = "select * from user";
        $enter = mysqli_query($this->connection, $pick);
        return $enter;
    }

    //this method is use for editing user details
    public function edit_user($id)
    {
        global $fromCon;
        $select= "select * from user where id ='$id'";
        $query= mysqli_query($fromCon->connection, $select);
        return $query;
    }

    public function update()
    {
       
        if (isset($_POST['update']))
        {
            global $fromCon;
            $firstname= $fromCon->auto($_POST['firstname']);
            $lastname = $fromCon->auto($_POST['lastname']);
            $email = $fromCon->auto($_POST['email']);
            $phonnumber = $fromCon->auto($_POST['phonenumber']);
            $id = $_POST['id'];
            if ($this->update_user($firstname, $lastname, $email, $phonnumber, $id))
            {
                 $this-> create_session('<div class="alert alert-success"> Edited succefully </div>');
                header("location:view.php");
            }
            else
            {
                $this->create_session('<div class="alert alert-danger"> unable to edit succesfully </div>');
            }
        }

    }
    public function update_user($a,$b,$c,$d,$f)
    {
        global $fromCon;
        $update = "update user set firstname = '$a', lastname = '$b', email = '$c', phonenumber = '$d' where id = '$f'";
        $quary = mysqli_query($fromCon->connection, $update);
        if ($quary) {
            return true;
            # code...
        }
        else{
            return false;
        }
    }

    public function create_session($msg)
    {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        }
        else
        {
            $msg = "";
        }
    }

    public function dispaly_message()
    {
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
             
        }
    }

    public function delete($id)
    {
        global $fromCon;
        $delete = "delete from user where id='$id' ";
        $quary = mysqli_query($fromCon->connection,  $delete );
        return $quary;
    }
    public function personal($id){
       $result= $this->edit_user($id);
       return $result;

    }
    public function update_imaage($button_name,$file_name,$id){
        global $fromCon;
        if (isset($_POST[$button_name])) {
            $filename = $_FILES[$file_name]['name'];
            $tmpname =  $_FILES[$file_name]['tmp_name'];
            $filesize = $_FILES[$file_name]['size'];
            $filerror = $_FILES[$file_name]['error'];
            $seperate = explode(".", $filename);
            $get_ext = strtolower(end($seperate));
            $acceptable_ext = array("jpeg", "jpg", "png");
            if (in_array($get_ext, $acceptable_ext)) {
                if ($filerror===0) {
                    if ($filesize<50000000) {
                         $new_name=uniqid("",true).".".$filename;
                         $location='images/'.$new_name;
                         $move = move_uploaded_file( $tmpname, $location);
                         if($move) {
                             $update = "UPDATE user set photo = '$new_name' where id = '$id'";
                             $quary = mysqli_query($this->connection,$update);
                         }else{
                             echo "failed to update by all means!";
                         }

                    }else{
                        echo "image too large!";
                    }
                }else{
                    echo "error occured while updating your pic";
                    
                }
            }else{
                echo"does not recognise this file!";
            }
        }
    }
}

