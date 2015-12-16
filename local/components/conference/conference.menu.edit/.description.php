<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die ();
$arComponentDescription = array
    (
        "NAME" => GetMessage("NAME_COMPONENT"),
        "DESCRIPTION" => GetMessage("DESCRIPTION_COMPONENT"),
        "SORT" => 20,
        "PATH" => array
            (
                "ID" => "content",
                "NAME" => GetMessage("NAME_CONF"),
                "CHILD" => array
                    (
                    "ID"=> "Меню",
                    "NAME" => GetMessage("TOP_MENU"),
                    "SORT" => 10,"CHILD" =>
                            array
                            (
                                "ID" => "ConferenceMenuAdd",
                            )
                    ),
            ),
    );
?>