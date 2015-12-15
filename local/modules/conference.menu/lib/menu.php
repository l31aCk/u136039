<?php
namespace CONFERENCE\MENU;
use Bitrix\Main\Application;
use Bitrix\Main\Entity;
use Bitrix\Main\Entity\Event;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\UserTable;
Loc::loadMessages(__FILE__);
class ConferenceMenuTable extends Entity\DataManager {
    public static function getFilePath()
    {
        return __FILE__;
    }
    /*Название таблицы HL в БД*/
    public static function getTableName()
    {
        return 'conference_menu';
    }
    /*Описание полей сущности (соответсвуют полям HL EmployeeKPI)*/
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true
            ),
            'UF_URL' => array(
                'data_type' => 'string'
            ),
            'UF_VALUE' => array(
                'data_type' => 'string'
            ),
            'UF_ACCESS' => array(
                'data_type' => 'integer'
            )
 );
 }
}






class MENUConference {

    //Компонент conference.menu.create
    public static function AddMenu($DValue, $DAccess, $DURL) {
        if(!$DValue || !$DAccess || !$DURL) {
            return array();
        }

        //Добавляем значения
        $arValue = array(
           'UF_VALUE' => $DValue,
           'UF_ACCESS' => $DAccess,
           'UF_URL' => $DURL
        );

        //Делаем запрос в БД и возвращаем ответ
        return ConferenceMenuTable::add($arValue);

    }
	
	
	
	//Компонент conference.menu.general
	public static function MenuValues($is_user)
    {   
        if($is_user == false)
		{
		//Показывать пункты только для гостей
		$filter = array(
		        'LOGIC' => 'OR',
				array('UF_ACCESS' => 3),
                array('UF_ACCESS' => 1));
        }
		else
		{
		//Показывать пункты только для пользователей
		$filter = array(
		        'LOGIC' => 'OR',
				array('UF_ACCESS' => 2),
                array('UF_ACCESS' => 1)
				);
		}
		
		if(!isset($is_user)) $filter = array(); //Для компонента conference.menu.edit
		
        $req = ConferenceMenuTable::getList(array(
            'select' => array(
                'ID', 'UF_VALUE', 'UF_ACCESS', 'UF_URL'
            ),
            'filter' => $filter
        ));
		
		$i=0;
		while($res = $req->Fetch())
		{
		$res[] = $req;

		$ob[$i]["ID"] = $res["ID"];
		$ob[$i]["UF_VALUE"] = $res["UF_VALUE"];
		$ob[$i]["UF_ACCESS"] = $res["UF_ACCESS"];
		$ob[$i]["UF_URL"] = $res["UF_URL"];

		$i++;
		}
		return $ob;
    }
	
    //Компонент conference.menu.edit | Обновление данных
	public static function UpdateMenu($menu_id, $value, $url)
    {
		
        $req = ConferenceMenuTable::getList(array(
            'select' => array(
                'ID', 'UF_VALUE', 'UF_ACCESS', 'UF_URL'
            ),
            'filter' => array(
			    'ID' => $menu_id
            )
        ));
		
		if($row = $req->Fetch())
		{
		$row[] = $req;

		
		$res = array('0' => array(
		   'ID' => $row["ID"],
		   'UF_VALUE' => $value,
		   'UF_ACCESS' => $row["UF_ACCESS"],
		   'UF_URL' => $url));
		

		$ob = ConferenceMenuTable::update($menu_id, $res[0]);
		return $ob;
		}
		else return false;
    }
	
    //Компонент conference.menu.edit | Удаление данных	
	public static function DeleteMenu($menu_id)
    {
		
        $req = ConferenceMenuTable::getList(array(
            'select' => array(
                'ID', 'UF_VALUE', 'UF_ACCESS', 'UF_URL'
            ),
            'filter' => array(
			    'ID' => $menu_id
            )
        ));
		
		if($row = $req->Fetch())
		{
		$row[] = $req;

		
		$res = array('0' => array(
		   'ID' => $row["ID"],
		   'UF_VALUE' => $row["UF_VALUE"],
		   'UF_ACCESS' => $row["UF_ACCESS"],
		   'UF_URL' => $row["UF_URl"]));
		
		$ob = ConferenceMenuTable::delete($res[0]["ID"]);
		return $ob;
		}
		else return false;
    }
	
}
