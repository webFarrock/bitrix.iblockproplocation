<?php

IncludeModuleLangFile(__FILE__);

if (!class_exists("WebFarrockIblockPropLocation")){
	class WebFarrockIblockPropLocation{
		function GetUserTypeDescription(){
			return array(
				"PROPERTY_TYPE"         => "S",
				"USER_TYPE"             => "salelocation",
				"DESCRIPTION"           => GetMessage('WEBFARROCK_IBLOCKPROP_LOCATION_PROP_NAME'),
				"GetPropertyFieldHtml"  => array("WebFarrockIblockPropLocation", "GetPropertyFieldHtml"),
				"GetAdminListViewHTML"	=> array("WebFarrockIblockPropLocation", "GetAdminListViewHTML"),
				"GetPublicViewHTML"	    => array("WebFarrockIblockPropLocation", "GetAdminListViewHTML"),
			);
		}

		function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName){

			if(!CModule::IncludeModule('sale')) return false;

			global $APPLICATION;

			ob_start();

			$APPLICATION->IncludeComponent(
				"webfarrock:sale.location.selector.search",
				"search-in-admin",
				array(
					"COMPONENT_TEMPLATE" => "search",
					"ID" => htmlspecialcharsbx($value['VALUE']),
					"CODE" => "",
					"INPUT_NAME" => htmlspecialcharsbx($strHTMLControlName['VALUE']),
					"PROVIDE_LINK_BY" => "id",
					"JSCONTROL_GLOBAL_ID" => "",
					"JS_CALLBACK" => "",
					"SEARCH_BY_PRIMARY" => "Y",
					"EXCLUDE_SUBTREE" => "",
					"FILTER_BY_SITE" => "Y",
					"SHOW_DEFAULT_LOCATIONS" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000"
				),
				false
			);

			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}

		function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName){
			if(!CModule::IncludeModule('sale')) return false;

			return Bitrix\Sale\Location\Admin\LocationHelper::getLocationStringById($arProperty['VALUE']);

		}
	}


} // class exists

