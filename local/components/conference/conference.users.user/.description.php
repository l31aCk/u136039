<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die ();
$arComponentDescription = array
    (
        "NAME" => GetMessage("NAME_COMPONENT"),
        "DESCRIPTION" => GetMessage("DESCRIPTION_COMPONENT"),
        "SORT" => 20 ,
        "PATH" => array
            (
                "ID" => "content",
                "NAME" => GetMessage("NAME_TOP"),
                "CHILD" => array
                    (
                    "ID"=> "general",
                    "NAME" => GetMessage("NAME_CONF"),
                    "SORT" => 10,"CHILD" =>
                            array
                            (
                                "ID" => "UserMessagesConference",
                            )
                    ),
            ),
    );
?>