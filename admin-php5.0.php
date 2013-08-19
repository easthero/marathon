<?php
session_start();
error_reporting(E_ALL);
include("PFBC/Form.php");

if(isset($_POST["form"])) {
    if(Form::isValid($_POST["form"])){

		include("header.php");

		date_default_timezone_set('Asia/Shanghai');
		$db = new PDO('sqlite:marathon.db');
		$comment_sql = "select * from Comment";
		$comment_result = $db->query($comment_sql);
		echo '<p>网上留言</p>';
		echo '<table class="table table-striped">';
		echo '<tbody><thead><tr><th>编号</th><th>姓名</th><th>联系电话</th><th>留言</th><th>时间</th></tr></thead>';
		foreach($comment_result as $row){
			echo "<tr><td>" . $row['ID'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['Phone'] . "</td>";
			echo "<td>" . $row['Comment'] . "</td>";
			echo "<td>" . date("Y-m-d H:i:s", $row['Date']) . "</td></tr>";
		}
		echo "</tbody></table>";

#表结构
#ID Name Sex Age IDCard Address Phone Contact ContactPhone Date;
		$csv = array(array(
			mb_convert_encoding("编号", "GBK", "UTF-8"),
			mb_convert_encoding("姓名", "GBK", "UTF-8"),
//			mb_convert_encoding("赛事类型", "GBK", "UTF-8"),
			mb_convert_encoding("性别", "GBK", "UTF-8"),
			mb_convert_encoding("年龄", "GBK", "UTF-8"),
			mb_convert_encoding("身份证号码", "GBK", "UTF-8"),
			mb_convert_encoding("电子邮件", "GBK", "UTF-8"),
			mb_convert_encoding("住址", "GBK", "UTF-8"),
			mb_convert_encoding("所属区域", "GBK", "UTF-8"),
			mb_convert_encoding("联系电话", "GBK", "UTF-8"),
			mb_convert_encoding("紧急联系人", "GBK", "UTF-8"),
			mb_convert_encoding("紧急联系人电话", "GBK", "UTF-8"),
			mb_convert_encoding("报名时间", "GBK", "UTF-8"),
			));
		$sql = "select * from User";
		$result = $db->query($sql);
		echo '<p>报名信息	<a href="registerinfo.csv">点此下载报名表格</a></p>';
		echo '<table class="table table-striped">';
//		echo '<tbody><thead><tr><th>编号</th><th>姓名</th><th>赛事类型</th><th>性别</th><th>年龄</th><th>身份证号码</th><th>电子邮件</th><th>住址</th><th>所属区域</th><th>联系电话</th><th>紧急联系人</th><th>紧急联系人电话</th><th>报名时间</th></tr></thead>';
		echo '<tbody><thead><tr><th>编号</th><th>姓名</th><th>性别</th><th>年龄</th><th>身份证号码</th><th>电子邮件</th><th>住址</th><th>所属区域</th><th>联系电话</th><th>紧急联系人</th><th>紧急联系人电话</th><th>报名时间</th></tr></thead>';
		foreach($result as $row){
			echo "<tr><td>" . $row['ID'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
//			echo "<td>" . $row['MatchType'] . "</td>";
			echo "<td>" . $row['Sex'] . "</td>";
			echo "<td>" . $row['Age'] . "</td>";
			echo "<td>" . $row['IDCard'] . "</td>";
			echo "<td>" . $row['Email'] . "</td>";
			echo "<td>" . $row['Address'] . "</td>";
			echo "<td>" . $row['Region'] . "</td>";
			echo "<td>" . $row['Phone'] . "</td>";
			echo "<td>" . $row['Contact'] . "</td>";
			echo "<td>" . $row['ContactPhone'] . "</td>";
			echo "<td>" . date("Y-m-d H:i:s", $row['Date']) . "</td></tr>";
			$csvdata = array(
				$row['ID'],
				mb_convert_encoding($row['Name'], "GBK", "UTF-8"),
//				mb_convert_encoding($row['MatchType'], "GBK", "UTF-8"),
				mb_convert_encoding($row['Sex'], "GBK", "UTF-8"),
				mb_convert_encoding($row['Age'], "GBK", "UTF-8"),
				'="' . $row['IDCard'] . '"',
				'="' . $row['Email'] . '"',
				mb_convert_encoding($row['Address'], "GBK", "UTF-8"),
				mb_convert_encoding($row['Region'], "GBK", "UTF-8"),
				'="' . $row['Phone'] . '"',
				mb_convert_encoding($row['Contact'], "GBK", "UTF-8"),
				'="' . $row['ContactPhone'] . '"',
				date("Y-m-d H:i:s", $row['Date'])
			);
			array_push($csv, $csvdata);
		}
		echo "</tbody></table>";

		$fp = fopen("registerinfo.csv", "w");
	//	fwrite($fp,"\xEF\xBB\xBF");
		foreach ($csv as $fields){
			fputcsv($fp, $fields);
		}

		require("footer.php");
		exit();
	}else{
   	 header("Location: " . $_SERVER["PHP_SELF"]);
   	 exit();
	}
}

#显示表单
include("header.php");
$form = new Form("admin");
$form->addElement(new Element_Hidden("form", "admin"));
$form->addElement(new Element_HTML('<legend>请输入密码</legend>'));
$form->addElement(new Element_Password("密码:", "Password", array(
        "required" => 1,
        "validation" => new Validation_RegExp("/^c2tm4r4th0n2014$/",
        "Error: 密码错误，请重新输入"),
)));
$form->addElement(new Element_Button("提交"));
$form->render();
require("footer.php");
?>
