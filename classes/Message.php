<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../lib/Session.php');
    Session::init();
?>

<?php
 class Message
 {
 	private $db;


 	public function __construct()
 	{
 		$this->db=new Database();

 	}

 	public function sendMsg($msg){


 		$msg_type = "text";
        $user_id = Session::get('userid');

		$this->db->query('INSERT INTO messages (message,msg_type,user_id) VALUES(:message, :msg_type, :user_id) ');
        $this->db->bind(':message',$msg);
        $this->db->bind(':msg_type',$msg_type);
        $this->db->bind(':user_id',$user_id);


        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
 	}

    public function sendFile($file_name , $tmp_name){

        $extensions = array('jpg','jpeg','png','pdf','zip','docx');
        $file_ext = explode(".", $file_name);
        $file_extension =  strtolower(end($file_ext));
        $unique_file = substr(md5(time()), 0, 10).'.'.$file_extension;
        $uploaded_file = "../upload/message/".$unique_file;

        if (!in_array($file_extension, $extensions))
        {
            return false;
            exit();
        }else{
            move_uploaded_file($tmp_name, $uploaded_file);
            $user_id = Session::get('userid');

            $this->db->query('INSERT INTO messages (message,msg_type,user_id) VALUES(:message, :msg_type, :user_id) ');
            $this->db->bind(':message',$uploaded_file);
            $this->db->bind(':msg_type',$file_extension);
            $this->db->bind(':user_id',$user_id);


            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

    }

    public function getCleanMsgId(){
        $user_id = Session::get('userid');
        $this->db->query('SELECT  clean_message_id FROM clean  WHERE clean_user_id=:clean_user_id');
        $this->db->bind(':clean_user_id',$user_id);
        $row = $this->db->single();
        $last_msg_id = $row->clean_message_id;
        return $last_msg_id;

    }


     public function getLastMagId(){
        $this->db->query('Select id from messages ORDER BY id desc limit 1');
        $row = $this->db->single();
        return $row->id;

    }


    public function getAllMsg($clean_message_id , $msg_table_id){
        $this->db->query('Select * from messages
            inner join users
            on messages.user_id = users.id
            WHERE messages.id
            between :clean_message_id and :msg_table_id
            order by messages.id asc');

        $this->db->bind(':clean_message_id',$clean_message_id);
        $this->db->bind(':msg_table_id',$msg_table_id);

        $results = $this->db->resultSet();

        if($this->db->rowCount()>0)
         {
            return $results;
         }else {
            return false;
         }
    }

    public function getTotalNumbersOnline(){
        $this->db->query('SELECT  * FROM users  WHERE status=:status');
        $this->db->bind(':status',1);
        $this->db->execute();

        if($this->db->rowCount()>0)
         {
            return $this->db->rowCount();
         }else {
            return false;
         }
    }



}
