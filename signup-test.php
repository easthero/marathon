<?php
session_start();
error_reporting(E_ALL);
include("PFBC/Form.php");

date_default_timezone_set('Asia/Shanghai');
#$start = mktime(0, 0, 0, 10, 1, 2013);
$start = mktime(0, 0, 0, 7, 1, 2013);
$diff = $start - time();

if ($diff >= 0 ){
?>

<!DOCTYPE html>
<html lang="zh-cn">
    <head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" type="text/css" href="countdown/css/styles.css" />
    <script src="countdown/js/jquery.min.js"></script>
    <script type="text/javascript" src="countdown/js/C3counter.js"></script>
    <title>长株潭半程马拉松比赛在线报名</title>
</head>
<body>
<div id="counter">
<div>
<h1>长株潭2014年元旦半程马拉松<h1>
<h1>开放注册倒计时<h1>
</div>
<script type="text/javascript">
    C3Counter("counter", { startTime :<?php echo $diff; ?> });
</script>
</div>
</body>

<?php
} else {
if(isset($_POST["form"])) {
    if(Form::isValid($_POST["form"])){
		Form::clearValues("register");
		$Name = $_POST['Name'];
//		$MatchType = $_POST['MatchType'];
		$Phone = $_POST['Phone'];
		$IDCard = $_POST['IDCard'];
		$Email = $_POST['Email'];
		$Region = $_POST['Region'];
		$Address = $_POST['Address'];
		$Contact = $_POST['Contact'];
		$ContactPhone = $_POST['ContactPhone'];
		
		if ( strlen($IDCard) == 15 ){
			$birthyear = substr($IDCard, 6, 2);
			$birthyear = "19" . $birthyear;
			$sexflag = substr($IDCard, 13,1);
		}else{
			$birthyear = substr($IDCard, 6, 4);
			$sexflag = substr($IDCard, 16,1);
		}

		$Age = date("Y", time()) - $birthyear;
		if (is_numeric($sexflag)&($sexflag&1)){
			$Sex = '男';
		}else{
			$Sex = '女';
		}

		include("header.php");
		$db = new PDO('sqlite:marathon.db');
		$sql_query = "select * from User where IDCard = $IDCard";
		$sth = $db->prepare($sql_query);
		$sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
		if ( $data !== false ){
			echo "<p><strong>您已经报过名了，请不要重复报名</strong></p>";
			echo "<p><strong>您的的报名资料如下</strong></p>";
			echo "<pre>";
			echo "<table>";
			echo "<tr><td>姓名:</td><td>" . $data['Name'] . "</td></tr>";
//			echo "<tr><td>赛事类型:</td><td>" . $data['MatchType'] . "</td></tr>";
			echo "<tr><td>性别:</td><td>" . $data['Sex'] . "</td></tr>";
			echo "<tr><td>年龄:</td><td>" . $data['Age'] . "</td></tr>";
			echo "<tr><td>身份证号码:</td><td>" . $data['IDCard'] . "</td></tr>";
			echo "<tr><td>电子邮件:</td><td>" . $data['Email'] . "</td></tr>";
			echo "<tr><td>住址:</td><td>" . $data['Address'] . "</td></tr>";
			echo "<tr><td>所属区域:</td><td>" . $data['Region'] . "</td></tr>";
			echo "<tr><td>联系电话:</td><td>" . $data['Phone'] . "</td></tr>";
			echo "<tr><td>紧急联系人:</td><td>" . $data['Contact'] . "</td></tr>";
			echo "<tr><td>紧急联系人电话:</td><td>" . $data['ContactPhone'] . "</td></tr>";
			echo "</table>";
			echo "<p><strong>如果您的报名资料有误，请<a target='_blank' href='comment.php'>点击这里</a>向我们留言，我们将为您改正</strong></p>";
			require("footer.php");
			exit();
		}

		echo "<p><strong>您的的报名资料如下</strong></p>";
		echo "<pre>";
		echo "<table>";
		echo "<tr><td>姓名:</td><td>$Name</td></tr>";
//		echo "<tr><td>赛事类型:</td><td>$MatchType</td></tr>";
		echo "<tr><td>性别:</td><td>$Sex</td></tr>";
		echo "<tr><td>年龄:</td><td>$Age</td></tr>";
		echo "<tr><td>身份证号码:</td><td>$IDCard</td></tr>";
		echo "<tr><td>电子邮件:</td><td>$Email</td></tr>";
		echo "<tr><td>住址:</td><td>$Address</td></tr>";
		echo "<tr><td>所属区域:</td><td>$Region</td></tr>";
		echo "<tr><td>联系电话:</td><td>$Phone</td></tr>";
		echo "<tr><td>紧急联系人:</td><td>$Contact</td></tr>";
		echo "<tr><td>紧急联系人电话:</td><td>$ContactPhone</td></tr>";
		echo "</table>";
		echo "</pre>";
		echo "<p>如您的报名被确认，我们将及时通过电子邮件与您联系，感谢您的参与~</p>";		
		echo "<p>如您的资料有误，请<a href='comment.php' target='_blank'>点击这里</a>留言告知~，我们将帮您改正</p>";		

#表结构
#ID Name MatchType Sex Age IDCard Email Region Address Phone Contact ContactPhone Date;
//	$sql = "insert into User (Name, MatchType, Sex, Age, IDCard, Email, Region, Address, Phone, Contact, ContactPhone, Date) values (:Name, :MatchType, :Sex, :Age, :IDCard, :Email, :Region, :Address, :Phone, :Contact, :ContactPhone, :Date)";
		$sql = "insert into User (Name, Sex, Age, IDCard, Email, Region, Address, Phone, Contact, ContactPhone, Date) values (:Name, :Sex, :Age, :IDCard, :Email, :Region, :Address, :Phone, :Contact, :ContactPhone, :Date)";
		$Date = time();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':Name', $Name);
//		$stmt->bindParam(':MatchType', $MatchType);
		$stmt->bindParam(':Sex', $Sex);
		$stmt->bindParam(':Age', $Age);
		$stmt->bindParam(':IDCard', $IDCard);
		$stmt->bindParam(':Email', $Email);
		$stmt->bindParam(':Region', $Region);
		$stmt->bindParam(':Address', $Address);
		$stmt->bindParam(':Phone', $Phone);
		$stmt->bindParam(':Contact', $Contact);
		$stmt->bindParam(':ContactPhone', $ContactPhone);
		$stmt->bindParam(':Date', $Date);
		$stmt->execute();
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
$sexlist=array("男","女");
$form = new Form("register");
$form->addElement(new Element_Hidden("form", "register"));
$form->addElement(new Element_HTML('<legend>报名表</legend>'));
$form->addElement(new Element_Textbox("姓名:", "Name", array("required" => 1)));
//$MatchTypeOptions = array("半程马拉松", "十公里健康跑");
//$form->addElement(new Element_Radio("赛事类型:", "MatchType", $MatchTypeOptions, array("required" => 1)));
$form->addElement(new Element_Number("联系电话:", "Phone", array(
	"required" => 1,
	"validation" => new Validation_RegExp("/^[0-9]{8,12}$/",
	"Error: 联系电话须为8至12位数字"),
	"longDesc" => "电话格式为区号+固定电话或手机号码，如073188888888或15388888888",
)));
$form->addElement(new Element_Textbox("身份证号码:", "IDCard", array(
	"required" => 1,
	"validation" => new Validation_RegExp("/^[0-9]{15}$|^[0-9]{18}$|^[0-9]{17}[xX]$/",
	"Error: 身份证号码不合法")
)));
$form->addElement(new Element_Email("电子邮件:", "Email", array("required" => 1)));
$form->addElement(new Element_Textbox("住址:", "Address", array("required" => 1)));
$RegionOptions = array("长沙", "株洲", "湘潭", "其它地区");
$form->addElement(new Element_Radio("您所在的地区:", "Region", $RegionOptions, array("required" => 1)));
$form->addElement(new Element_Textbox("紧急联系人:", "Contact", array("required" => 1)));
$form->addElement(new Element_Number("紧急联系人电话:", "ContactPhone", array(
	"required" => 1,
	"validation" => new Validation_RegExp("/^[0-9]{8,12}$/",
	"Error: 紧急联系人电话须为8至12位数字"),
)));
$Agreeoptions = array("本人已认真阅读了长株潭半程马拉松赛的《网上报名须知》及《参赛者声明》，并同意其中的各项条款！");
$form->addElement(new Element_Checkbox(" ", "Agree", $Agreeoptions, array("required" => 1)));
$form->addElement(new Element_Button("提交"));
$form->render();
require("footer.php");
}
?>
