<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die ();
$arComponentParameters = array(
        "PARAMETERS" =>
            array(
					"SHOW" => array
                    (
                        "PARENT" => "ADDITIONAL_SETTINGS",
                        "NAME" => GetMessage("SHOW"),
                        "TYPE" => "LIST",
						"VALUES"    =>  array(
                                0 =>  GetMessage("SHOW_NEW"),
                                1 =>  GetMessage("SHOW_OLD"))
                    )
                  )
             );
?>