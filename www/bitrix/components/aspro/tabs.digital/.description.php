<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
 
$arComponentDescription = array(
	"NAME" => GetMessage("T_SECONTEXT_TABS_NAME"),
	"DESCRIPTION" => GetMessage("T_SECONTEXT_TABS_DESCRIPTION"),
	"ICON" => "/images/news-list.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		'ID' => 'aspro',
		'NAME' => GetMessage('SECONTEXT')
	),
	"COMPLEX" => "N"
);
?>