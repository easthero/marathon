<?php
session_start();
error_reporting(E_ALL);
include("PFBC/Form.php");

if(isset($_POST["form"])) {
    if(Form::isValid($_POST["form"])){
		Form::clearValues("comment");
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Comment = $_POST['Textarea'];

#表结构
#ID Name Phone Comment;
		$db = new PDO('sqlite:marathon.db');
		$sql = "insert into Comment (Name, Phone, Comment, Date) values (:Name, :Phone, :Comment, :Date)";
		$Date = time();
		$stmt = $db->prepare($sql);

		$stmt->bindParam(':Name', $Name);
		$stmt->bindParam(':Phone', $Phone);
		$stmt->bindParam(':Comment', $Comment);
		$stmt->bindParam(':Date', $Date);
		$stmt->execute();
		require("header.php");
		echo '<pre>您的留言已提交，我们将尽快处理，感谢您的参与~</pre>';
		require("footer.php");
		exit();
	}else{
   	 header("Location: " . $_SERVER["PHP_SELF"]);
   	 exit();
	}
}

#显示表单
include("header.php");

?>
<?php
$form = new Form("comment");
$form->addElement(new Element_Hidden("form", "comment"));
$form->addElement(new Element_HTML('<legend>报名资料有误？在这里留言给我们</legend>'));
$form->addElement(new Element_Textbox("姓名:", "Name", array("required" => 1)));
$form->addElement(new Element_Number("联系电话:", "Phone", array(
	"required" => 1,
	"validation" => new Validation_RegExp("/^[0-9]{8,12}$/",
	"Error: 联系电话须为8至12位数字"),
	"longDesc" => "电话格式为区号+固定电话或手机号码，如073188888888或15388888888",
)));
$form->addElement(new Element_Textarea("留言:", "Textarea", array("required" => 1)));
$form->addElement(new Element_Button("提交"));
$form->render();
require("footer.php");
?>
