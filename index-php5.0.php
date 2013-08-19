<?php
session_start();
error_reporting(E_ALL);
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
	<title>长株潭业余半程马拉松比赛在线报名</title>
</head>
<body>

<div class="container">
<h1>长株潭业余半程马拉松比赛在线报名</h1>

<strong>比赛说明</strong>
<pre><ol><li>比赛时间：2014年1月1日（星期三）上午9点</li><li>比赛起点：株洲河西沿江风光带四大桥音乐广场</li><li>比赛项目：半程马拉松(约21公里)</li><li>费用说明：现场每人收取20元的报名费，用于包括制作号码布、购买饮料和奖品等开支。请参赛者在当天尽量自备零钱。</li></ol></pre>

<strong>报名资格</strong>
<pre>参赛者身体状况要求：马拉松赛是一项大强度长距离的竞技运动，也是一项高风险的竞技项目，对参赛者身体状况有较高的要求，参赛者应身体健康，有长期参加跑步锻炼的基础。
有以下疾病患者不宜参加比赛： 
<ol><li>先天性心脏病和风湿性心脏病患者</li><li>高血压和脑血管疾病患者</li><li>心肌炎和其他心脏病患者</li><li>冠状动脉病患者和严重心律不齐者</li><li>血糖过高或过少的糖尿病患者</li><li>其它不适合运动的疾病患者</li>在比赛中，因个人身体及其它个人原因导致的人身损害和财产损失，由参赛者个人承担责任。我们强烈建议参赛者去相应医疗机构进行健康体检。</pre>

<strong>注意事项</strong>
<pre><ol><li>请在报名前仔细阅读参赛者声明</li><li>报名者应真实、准确填写报名信息，网络报名信息一旦提交之后，不能更改</li><li>关于紧急联系人及电话，请填写为未参加跑步活动的人员，跑友之间相互填写为紧急联系人的，一律不予确认。</li></ol></pre>

<strong>参赛者声明</strong>
<p>本人自愿参加长株潭半程马拉松活动，并发表以下免责声明:</p>
<pre><ol><li>本人系具备完全民事行为能力的成年人，自愿参加此次马拉松跑步活动，并在“长沙跑步爱好者”网站及长沙、株洲、湘潭跑步QQ群约伴，自由结合，共同跑步。该网站及QQ群对每个活动报名者并无组织、委派等其他任何法律关系；参加跑步活动成员均处于平等地位，活动分工仅仅为了发挥各自优势，并无上下级或者指挥与被指挥关系;</li><li>本人已经充分了解参加跑步活动过程中可能面临的风险，包括但不限于：交通意外事故；跌倒；碰伤、扭伤、骨伤；中暑、抽筋；蛇虫侵扰；雷击；被歹徒打劫、抢夺，等等。</li><li>参加活动前，本人身体健康，经常性参加跑步锻炼及训练。没有心脏疾病或其它心血管类等不宜跑步运动的疾病。</li><li>在活动过程中，如果遇到危险，本人相信活动中其他所有成员均会尽力救助，但即使如此仍不能完全避免伤害的产生时，声明人不向其他成员主张任何赔偿责任，除非该伤害是由于其他成员的故意所导致。</li><li>本人完全清楚上述免责条款内容和后果，并已通知家人和征得家人同意之后，现予以确认，特此声明。</li></pre>

<?php
include("PFBC/Form.php");

$form = new Form("form");
$form->configure(array("action" => "signup.php",));
$form->addElement(new Element_Button("进入报名"));
$form->render();
?>

</div>
</body>
</html>
