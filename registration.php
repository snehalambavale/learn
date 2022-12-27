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
    case 'login':
      if(isset($_POST['email']) && $_POST['email']!="" && isset($_POST['password']) && $_POST['password']!=""){
        $email=trim($_POST['email']);
        $password=trim($_POST['password']);
        $sql="SELECT id,name,phone,email FROM user WHERE email='$email' AND password='$password'";
        $res=mysqli_query($conn,$sql);
        if (mysqli_num_rows($res)>0) {
          while ($row=mysqli_fetch_assoc($res)) {
            $user[]=$row;
          }
          $response['status']=true;
          $response['message']="Login successfull";
          $response['user']=$user;
        }else{
          $response['status'] = false; 
          $response['message'] = 'Invalid username or password';
        }
      }else{
        $response['status'] = false; 
        $response['message'] = 'Something went wrong. Try again later.';
      } 
      echo json_encode($response); 
      break;
    case 'register':
    if(isset($_POST['name']) && $_POST['name']!="" && isset($_POST['email']) && $_POST['email']!="" && isset($_POST['phone']) && $_POST['phone']!="" && isset($_POST['password']) && $_POST['password']!="" && isset($_POST['confirm_password']) && $_POST['confirm_password']!=""){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    $duplicate=mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
    if (mysqli_num_rows($duplicate)>0){
    $response['status'] = false; 
      $response['message'] = 'This email already rated by someone.';
    }
    $q="INSERT INTO user(name,phone,email,password,confirm_password) VALUES('$name','$phone','$email','$password','$confirm_password')";
    $res=mysqli_query($conn,$q);
    if($res){
    $response['status'] = true; 
      $response['message'] = 'Your registration is successfully done.';
    }else{
    $response['status'] = false; 
      $response['message'] = 'Something went wrong.';
      $response['error'] = mysqli_error($conn);
    }
    }else{
    $response['status'] = false; 
      $response['message'] = 'Please fill all mandatory field.';
    }
    echo json_encode($response);
    break;
}

}
?>
