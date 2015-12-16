<?php
namespace CONFERENCE\USERS;
use Bitrix\Main\Application;
use Bitrix\Main\Entity;
use Bitrix\Main\Entity\Event;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\UserTable;
Loc::loadMessages(__FILE__);
class ConferenceUsersTable extends Entity\DataManager{
    public static function getFilePath()
    {
        return __FILE__;
    }
    /*Название таблицы HL в БД*/
    public static function getTableName()
    {
        return 'conference_users';
    }
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true
            ),
            'UF_USID' => array(
                'data_type' => 'integer',
                'required' => true
            ),
            'UF_CONFID' => array(
                'data_type' => 'ineger',
                'required' => true
             ),
            'UF_RANG' => array(
                'data_type' => 'integer'
             ),
            'UF_WORK' => array(
                'data_type' => 'string'
             ),
            'UF_STATUS' => array(
                'data_type' => 'integer'
             ),
            'UF_THESIS' => array(
                'data_type' => 'string'
             ),
 //Описываем все связи с другими таблицами (внешние ключи)
 new Entity\ReferenceField(
     'UF_CONFID',
     'Bitrix\Iblock\ElementTable',
     array('=this.UF_CONFID' => 'ref.ID')
 ),
 new Entity\ReferenceField(
     'UF_USID',
     'Bitrix\Main\UserTable',
     array('=this.UF_USID' => 'ref.ID')
 )
 );
 }
}



class ConferenceAdminTable extends Entity\DataManager{
    public static function getFilePath()
    {
        return __FILE__;
    }
    /*Название таблицы HL в БД*/
    public static function getTableName()
    {
        return 'conference_admin';
    }
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true
            ),
            'UF_USID' => array(
                'data_type' => 'integer',
                'required' => true
            ),
            'UF_CONFID' => array(
                'data_type' => 'ineger',
                'required' => true
             ),
 //Описываем все связи с другими таблицами (внешние ключи)
 new Entity\ReferenceField(
     'UF_CONFID',
     'Bitrix\Iblock\ElementTable',
     array('=this.UF_CONFID' => 'ref.ID')
 ),
 new Entity\ReferenceField(
     'UF_USID',
     'Bitrix\Main\UserTable',
     array('=this.UF_USID' => 'ref.ID')
 )
 );
 }
}






class USERSConference {



    //Компонент conference.menu.create
    public static function UsersAddConference($usid, $confid, $rang, $work, $thesis) {
        if(!$rang || !$work || !$thesis ) {
            return array();
        }


        //Добавляем значения
        $arValue = array(
           'UF_USID' => $usid,
           'UF_CONFID' => $confid,
           'UF_USID' => $usid,
           'UF_RANG' => $rang,
           'UF_WORK' => $work,
		   'UF_STATUS' => $status,
		   'UF_THESIS' => $thesis
        );

        //Делаем запрос в БД и возвращаем ответ
        return ConferenceUsersTable::add($arValue);

    }
	

	
		//Компонент conference.menu.general
	public static function ShowConferences($limit)
    {   

		if($limit == 0) $filter = array('>=UF_DATE' =>  \Bitrix\Main\Type\DateTime::createFromUserTime(date("d.m.Y") . ' 00:00:00'));
		else $filter = array('<UF_DATE' =>  \Bitrix\Main\Type\DateTime::createFromUserTime(date("d.m.Y") . ' 00:00:00'));
		
		
        $req = ConferenceTable::getList(array(
            'select' => array(
                'ID', 'UF_TOPIC', 'UF_PLACE', 'UF_DATE'
            ),
            'filter' => $filter
        ));
		
		$i=0;
		while($res = $req->Fetch())
		{
		$res[] = $req;

		$ob[$i]["ID"] = $res["ID"];
		$ob[$i]["UF_TOPIC"] = $res["UF_TOPIC"];
		$ob[$i]["UF_PLACE"] = $res["UF_PLACE"];
		$ob[$i]["UF_DATE"] = $res["UF_DATE"];

		$i++;
		}
		return $ob;
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
