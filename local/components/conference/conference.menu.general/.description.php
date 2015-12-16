<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die ();
$arComponentDescription = array
    (
        "NAME" => GetMessage("NAME_COMPONENT"),
        "DESCRIPTION" => GetMessage("DESCRIPTION_COMPONENT"),
        "SORT" => 20,
		"AREA_BUTTONS" => array( 
        array( 
        'URL' => "http://localhost:8082/menu/add.php", 
        'SRC' => '/images/add.png', 
        'TITLE' => "Добавить новый пункт" 
        ),
		array( 
        'URL' => "http://localhost:8082/menu/edit.php", 
        'SRC' => '/images/edit.png', 
        'TITLE' => "Изменение меню" 
        )), 
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
                                "ID" => "ConferenceMenuOut",
                            )
                    ),
            ),
    );
?>