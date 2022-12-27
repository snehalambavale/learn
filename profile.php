<?php
$conn=mysqli_connect("localhost","root","","home");
if (!$conn) {
   
  die("Connection failed: " . mysqli_connect_error());
  } 
?>

<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
$response=array();
if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'update':
    if(isset($_POST['email']) && $_POST['email']!=""){
      $email=$_POST['email'];
      $name=$_POST['name'];
      $last_name=$_POST['last_name'];
      $role=$_POST['role'];
      $duplicate=mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
      if (mysqli_num_rows($duplicate)>0){
    
      $q="UPDATE `user` SET `name`='$name',`last_name`='$last_name',`role`='$role' WHERE email='$email'";
      $res=mysqli_query($conn,$q);
      if($res){
        $response['status'] = true; 
        $response['message'] = 'Your Profile is Updated successfully.';
      
      }
    
    }else{
    $response['status'] = false; 
      $response['message'] = 'Something went wrong.';
      $response['error'] = mysqli_error($conn);
    }
    }
    echo json_encode($response);
    break;
}

}
?>
