<?php
require_once "model/DbUntil.class.php";
class User
{
    var $id;
    var $username;
    var $password;
    //保存等级
    var $level;
    //保存失败信息
    var $error;
    //保存成功信息
    var $success;
    //跳转的页面
    var $url;
    var $db;
    public function __construct(){
        $this->db = new DbUntil();
    }
    
    private function create($username,$password,$level){
        $this->username = $username;
        $this->password = $password;
        $this->level = $level;
    }
    /**
     * 注册方法，传两个参数
     * username代表用户名
     * password代表密码
     * 也可以使用不传的方式
     */
    public function register(){
        if(isset($_POST["username"])&isset($_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "select * from `m_user` where name=?";
            $this->db->search($sql,array($username),$con);
            if($con>0){
                $this->error = "用户名已存在";
            }else{
                $sql1 = "insert into `m_user`(`name`,`pass`) values(?,?)";
                $res = $this->db->addDelUpd($sql1,array($username,$password), $con);
                if($res){
                    $this->success = "注册成功";
                    $this->url="view/login.html";
                }
            }
        }
    }
    
    /**
     * 登陆方法
     */
    public function login(){
        if(isset($_POST["username"])&isset($_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "select * from `m_user` where `name`=? and `pass`=?";
            $arr = $this->db->search($sql,array($username,$password),$con);
            if($con>0){
                $this->success = "登陆成功";
                setcookie("username",$username);
                $this->url="view/user.html";
            }else {
                $this->error="用户名或者密码错误";
            }
        }
    }
    public function logout(){
        setcookie("username","",time()-1);
        $this->success = "退出成功";
        $this->url = "view/user.html";
    }
    public function __call($fun,$args){
        echo "不能调用不存在的方法${fun},"."参数是:";
        print_r($args);
    }
    //获取cookie
    public  function getCookie(){
        if(isset($_COOKIE["username"])){
            echo json_encode(array("statu"=>$_COOKIE["username"]));
        }else{
            echo json_encode(array("statu"=>false));
        }
    }
    //发送短信
    public function sendM(){
        if($_POST){
            
        }
    }
    
    
    /*
     * 文件上传方法
     */
    
    public function addFile(){
        if(is_uploaded_file($_FILES["filename"]["tmp_name"])){
            //将上传文件移动到指定目录保存
            $nb= move_uploaded_file($_FILES["filename"]["tmp_name"],
                "up/".$_FILES["filename"]["name"]);
//             var_dump($nb);//true就是上传成功了
            $address = "up/".$_FILES["filename"]["name"];
            return $address;
        }else{
            return false;
        }
    }
    
    
    
    
}

?>