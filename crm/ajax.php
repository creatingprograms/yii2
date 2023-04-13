<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_GET["GO"]=='Y'):
			$arEventFields = array(
				"NAME"            => $_POST["NAME"],
				"TEXT"            => $_POST["TXT"],
				"COMPANY"          => $_POST["COMPANY"],
				"PHONE"           => $_POST["PHONE"],
				"EMAIL"           => $_POST["EMAIL"],
			);
			CEvent::Send("MAIN_FORM", SITE_ID, $arEventFields);
?>
<div  class="titleBig">

<?
/*	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	*/
?>

Спасибо <?=$_POST["NAME"];?>. Мы с вами свяжемся.</div>
<? endif;

if($_GET["CALL"]=='Y'):
			$arEventFields = array(
				"NAME"            => $_POST["NAME"],
				"TEXT"            => $_POST["TXT"],
				"COMPANY"          => $_POST["COMPANY"],
				"PHONE"           => $_POST["PHONE"],
				"EMAIL"           => $_POST["EMAIL"],
				"URL"           => $_POST["URL"],
			);
			CEvent::Send("CALL_FORM", SITE_ID, $arEventFields);
?>
<div  class="titleBig">

<?
/*	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	*/
?>

Спасибо <?=$_POST["NAME"];?>. Мы с вами свяжемся.</div>
<? endif;?>