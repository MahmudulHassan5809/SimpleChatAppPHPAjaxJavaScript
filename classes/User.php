<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../lib/Session.php');
    Session::init();
?>

<?php
 class User
 {
 	private $db;
 	private $fm;

 	public function __construct()
 	{
 		$this->db=new Database();

 	}

 	public function userRegister($data , $file){
 		$data = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
 		//Get Data From Form
 		$full_name = $data['full_name'];
 		$email = $data['email'];
 		$password = $data['password'];

 		$img_name = $file['img']['name'];
 		$img_tmp = $file['img']['tmp_name'];

        $extensions = array('jpg','jpeg','png');
        $img_ext = explode(".", $img_name);
        $img_extension =  strtolower(end($img_ext));
        $unique_image = substr(md5(time()), 0, 10).'.'.$img_extension;
        $uploaded_image = "upload/profile/".$unique_image;

        //Error Array
		$errors = array();

        //Name Validation
        if(empty($full_name)){
        	$name_error = "Full Name Is Required";
        	$errors['name_error'] = $name_error;
        }

        //Email Validation
        if(empty($email)){
        	$email_error = "Email Is Required";
        	$errors['email_error'] = $email_error;

        }elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
        	$email_error = "Please Enter A Valid EMail";
        	$errors['email_error'] = $email_error;
        }

        //Password Validation
        if(empty($password)){
        	$password_error = "Password Is Required";
        	$errors['password_error'] = $password_error;

        }elseif (strlen($password) < 6) {
        	$password_error = "Password Is Too Short";
        	$errors['password_error'] = $password_error;
        }

        //Image Validation
        if(empty($img_name)){
        	$image_error = "Image Is Required";
        	$errors['image_error'] = $image_error;

        }elseif (!in_array($img_extension, $extensions)) {
        	$image_error = "Inavlid Imgae Extension";
        	$errors['image_error'] = $image_error;
        }

        //Check Errors Length
        if(!empty($errors)){
        	return $errors;
        }else{
        	if ($this->findUserByEmail($email) !== true) {
        		move_uploaded_file($img_tmp, $uploaded_image);
        		$hash_password = password_hash($password,PASSWORD_DEFAULT);
        		$status = 0;
                $clean_status = 0;
	        	$this->db->query('INSERT INTO users (full_name,email,password,image,status,clean_status) VALUES(:full_name, :email, :password, :image, :status, :clean_status) ');
		        $this->db->bind(':full_name',$full_name);
		        $this->db->bind(':email',$email);
		        $this->db->bind(':password',$hash_password);
		        $this->db->bind(':image',$uploaded_image);
                $this->db->bind(':status',$status);
                $this->db->bind(':clean_status',$clean_status);

		        if($this->db->execute()){
		            return true;
		        }else{
		            return false;
		        }
        	} else {
        		$error_msg = "This Email Already Exists";
        		return $error_msg;
        	}

        }
    }


    public function findUserByEmail($email)
    {
         $this->db->query('Select * from users where email = :email');
         $this->db->bind(':email',$email);
         $row =$this->db->single();

         //check row

         if($this->db->rowCount()>0)
         {
             return true;
         }else {
             return false;
         }

    }

    public function userLogin($data){
        $data = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        $email = $data['email'];
        $password = $data['password'];

        //Email Validation
        if(empty($email)){
            $email_error = "Email Is Required";
            $errors['email_error'] = $email_error;

        }elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter A Valid EMail";
            $errors['email_error'] = $email_error;
        }

        //Password Validation
        if(empty($password)){
            $password_error = "Password Is Required";
            $errors['password_error'] = $password_error;

        }

        if(!empty($errors)){
            return $errors;
        }else{
            $this->db->query('Select * from users where email = :email');
            $this->db->bind(':email',$email);
            $row =$this->db->single();

            $hashed_password = $row->password ;
            if(password_verify($password , $hashed_password)){
                $this->updateStatus($row->id);

                if ($row->clean_status == 0 && $this->getLastMagId() !== false) {
                    $lastMsgId = $this->getLastMagId();

                    $lastMsgId = $lastMsgId + 1;

                    if($this->insertIntoCLeanTable($lastMsgId,$row->id)){
                        $this->updateCleanStatus($row->id);
                    }
                    Session::set("userlogin",true);
                    Session::set("userid",$row->id);
                    Session::set("username",$row->full_name);
                    echo "<script>window.location='index.php'</script>";
                } else {
                    Session::set("userlogin",true);
                    Session::set("userid",$row->id);
                    Session::set("username",$row->full_name);
                    echo "<script>window.location='index.php'</script>";
                }
            }else{
                return false;
            }
        }

    }

    public function updateStatus($id){
        $this->db->query('UPDATE  users set status=:status WHERE id=:id');
        $this->db->bind(':id',$id);
        $this->db->bind(':status',1);

        $this->db->execute();

    }


    public function getLastMagId(){
        $this->db->query('Select id from messages ORDER BY id desc limit 1');
        $row = $this->db->single();
        return $row->id;

    }


    public function insertIntoCLeanTable($lastMsgId , $user_id){
        $this->db->query('INSERT INTO clean (clean_message_id,clean_user_id) VALUES(:clean_message_id, :clean_user_id) ');
        $this->db->bind(':clean_message_id',$lastMsgId);
        $this->db->bind(':clean_user_id',$user_id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function updateCleanStatus($id){
        $this->db->query('UPDATE  users set clean_status=:clean_status WHERE id=:id');
        $this->db->bind(':id',$id);
        $this->db->bind(':clean_status',1);

        $this->db->execute();
    }


    public function logOut(){
        $id = Session::get('userid');
        $this->db->query('UPDATE  users set status=:status WHERE id=:id');
        $this->db->bind(':id',$id);
        $this->db->bind(':status',0);

        $this->db->execute();
    }


    public function changePass($data){
        $data = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        $password = $data['password'];
        $new_password = $data['new_password'];

        //Error Array
        $errors = array();

        //Password Validation
        if(empty($password)){
            $password_error = "Please Enter Current Password";
            $errors['password_error'] = $password_error;

        }
        if(empty($new_password)) {
            $password_error = "Please Enter New Pssword";
            $errors['new_password_error'] = $password_error;
        }elseif (strlen($new_password) < 6) {
            $password_error = "New Password Is Too Short...";
            $errors['new_password_error'] = $password_error;
        }

        if(!empty($errors)){
            return $errors;
        }else{
            $user_id = Session::get('userid');
            $this->db->query('Select * from users where id = :id');
            $this->db->bind(':id',$user_id);
            $row =$this->db->single();

            $hashed_password = $row->password ;
            $hash_new_password = password_hash($new_password,PASSWORD_DEFAULT);
            if(password_verify($password , $hashed_password)){
                $this->db->query('UPDATE  users set password=:password WHERE id=:id');
                $this->db->bind(':password',$hash_new_password);
                $this->db->bind(':id',$user_id);
                if ($this->db->execute()) {
                    return "Password SuccessFully Changed....";
                } else {
                   return "Some Thing Went Wrong...";
                }

            }else{
                return "Password Does Not Matched To Any Account...";
            }
        }

    }




}
