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
    case 'save':

    if($_POST['role']=="writer")
    {
      $post=$_POST['post'];
      $title=$_POST['title'];

           $sql=mysqli_query($conn,"SELECT * FROM posts");
 
  $response['status'] = true; 
      $response['message'] = 'Your Post is successfully done.';
    }else{
    $response['status'] = false; 
      $response['message'] = 'Something went wrong.';
      $response['error'] = mysqli_error($conn);
    }

echo json_encode($response); 
      break;


case 'insert':

 if($_POST['role']=="writer")
    {
      $post=$_POST['post'];
      $title=$_POST['title'];

        $q1="INSERT INTO posts(title,post) VALUES('$title','$post')";
    $res=mysqli_query($conn,$q1);

    $response['status'] = true; 
      $response['message'] = 'Your Post is successfully done.';
    }else{
    $response['status'] = false; 
      $response['message'] = 'Something went wrong.';
      $response['error'] = mysqli_error($conn);
    }

  echo json_encode($response); 
      break;


case 'edit':
    
      $q="UPDATE `posts` SET `title`='$title',`post`='$post' where role='writer'";
      $res=mysqli_query($conn,$q);
      if($res){
        $response['status'] = true; 
        $response['message'] = 'Your post is Updated successfully.';
      
      }  
    
    

    else{
    $response['status'] = false; 
      $response['message'] = 'Something went wrong.';
      $response['error'] = mysqli_error($conn);
    }
    }


    echo json_encode($response);
    break;


    case 'delete' :

 $q="delete from posts where id='$id'";
      $res=mysqli_query($conn,$q);
      if($res){
        $response['status'] = true; 
        $response['message'] = 'Your post is deleted successfully.';
      
      }  
    
    

    else{
    $response['status'] = false; 
      $response['message'] = 'Something went wrong.';
      $response['error'] = mysqli_error($conn);
    }
    }


    echo json_encode($response);
    break;



    default:

}


}
?>
