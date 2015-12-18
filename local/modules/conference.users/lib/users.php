<?php
namespace CONFERENCE\USERS;
use Bitrix\Main\Application;
use Bitrix\Main\Entity;
use Bitrix\Main\Entity\Event;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\UserTable;
Loc::loadMessages(__FILE__);
class ConferenceTable extends Entity\DataManager {
    public static function getFilePath()
    {
        return __FILE__;
    }
    /*Название таблицы HL в БД*/
    public static function getTableName()
    {
        return 'conference_general';
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
            'UF_TOPIC' => array(
                'data_type' => 'string'
            ),
            'UF_DATE' => array(
                'data_type' => 'datetime'
            ),
            'UF_PLACE' => array(
                'data_type' => 'integer'
            )
 );
 }
}



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
                'data_type' => 'integer',
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
			'UF_THESIS_FILE' => array(
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



class ConferenceMessagesTable extends Entity\DataManager{
    public static function getFilePath()
    {
        return __FILE__;
    }
    /*Название таблицы HL в БД*/
    public static function getTableName()
    {
        return 'conference_messages';
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
                'data_type' => 'integer',
                'required' => true
             ),
			'UF_STATUS' => array(
                'data_type' => 'integer'
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







class USERSConference{



    public static function UsersAddConference($usid, $confid, $rang, $work, $thesis, $thesis_name) {
        if(!$rang || !$work || !$thesis ) {
            return array();
        }

       $status = 0;
        //Добавляем значения
        $arValue = array(
           'UF_USID' => $usid,
           'UF_CONFID' => $confid,
           'UF_USID' => $usid,
           'UF_RANG' => $rang,
           'UF_WORK' => $work,
		   'UF_STATUS' => $status,
		   'UF_THESIS' => $thesis,
		   'UF_THESIS_FILE' => $thesis_name
        );

        //Делаем запрос в БД и возвращаем ответ
        return ConferenceUsersTable::add($arValue);

    }
	
    public static function AdminAddConference($usid, $confid) {

        //Добавляем значения
        $arValue = array(
           'UF_USID' => $usid,
           'UF_CONFID' => $confid);

        //Делаем запрос в БД и возвращаем ответ
        return ConferenceMessagesTable::add($arValue);

    }	

	
		//Компонент conference.menu.general
	public static function ShowConference($conference)
    {   
        $conference = intval($conference);
		$filter = array('ID' => $conference, '>UF_DATE' => \Bitrix\Main\Type\DateTime::createFromUserTime(date("d.m.Y") . ' 00:00:00'));
		
        $req = ConferenceTable::getList(array(
            'select' => array(
                'ID', 'UF_TOPIC', 'UF_PLACE', 'UF_DATE'
            ),
            'filter' => $filter
        ));
		
		if($res = $req->Fetch())
		{
		$res[] = $req;

		$ob[0]["ID"] = $res["ID"];
		$ob[0]["UF_TOPIC"] = $res["UF_TOPIC"];
		$ob[0]["UF_PLACE"] = $res["UF_PLACE"];
		$ob[0]["UF_DATE"] = $res["UF_DATE"];
		return $ob;
		}
		else return false;
    }
	
	public static function MessageToConference($user, $admin)
	{
	   if($admin == 'no') $req = ConferenceMessagesTable::getList(array('select' => array('ID', 'UF_USID', 'UF_CONFID', 'UF_STATUS'), 'filter' => array('UF_USID' => $user, 'UF_STATUS' => '1')));
       else  $req = ConferenceMessagesTable::getList(array('select' => array('ID', 'UF_USID', 'UF_CONFID', 'UF_STATUS'), 'filter' => array('UF_STATUS' => '')));

	   if($res = $req->fetch())
	   {
	   $res[] = $req;
	   return $res;
	   }
	   else return false;	
	}
	
	

	public static function ShowMessages()
    {   
		
        $req = ConferenceMessagesTable::getList(array('select' => array('ID', 'UF_USID', 'UF_CONFID'), 'filter' => array('UF_STATUS' => '')));

		
	    //$filter = array('UF_USID' => $user, 'UF_CONFID' => $conference);
		
		$i=0;
		while($res = $req->Fetch())
		{
		$res[] = $req;

		$ob[$i]["ID"] = $res["ID"];
		
		
        $row = ConferenceTable::getList(array(
            'select' => array(
                'ID', 'UF_TOPIC'
            ),
            'filter' => array('ID' => $res["UF_CONFID"])
        ));		
		
		if($rez = $row->fetch())
		{
		$rez[] = $row;
		
		$ob[$i]["UF_TOPIC"] = $rez["UF_TOPIC"];
		
		$uss = UserTable::getList(array(
            'select' => array(
                'ID', 'NAME', 'LAST_NAME'
            ),
            'filter' => array('ID' => $res["UF_USID"])
        ));		
		
		if($user = $uss->fetch())
        {
		$user[] = $uss;
		
		$ob[$i]["USID"] = $user["ID"];
		$ob[$i]["NAME"] = $user["NAME"];
		$ob[$i]["LAST_NAME"] = $user["LAST_NAME"];
		
		}
		
		}
		$i++;
		}
	return $ob;
    }
	
    //Компонент conference.menu.edit | Обновление данных
	public static function UpdateConference($id)
    {

        $req = ConferenceMessagesTable::getList(array('select' => array('ID', 'UF_USID', 'UF_CONFID'), 'filter' => array('ID' => $id)));
		
		if($row = $req->fetch())
		{
		$row[] = $req;
		
		$res = array('0' => array('UF_STATUS' => '1'));
		 
		$ob = ConferenceMessagesTable::update($row["ID"], $res[0]);
		
		$ret = ConferenceUsersTable::getList(array('select' => array('ID', 'UF_STATUS'), 'filter' => array('UF_USID' => $row["UF_USID"], 'UF_CONFID' => $row["UF_CONFID"])));
		
		if($rem = $ret->fetch())
		{
		$rem[] = $ret;
		

		$rel = array('0' => array(
		   'UF_STATUS' => '1'));
		 
		$ob2 = ConferenceUsersTable::update($rem["ID"], $rel[0]);
		
		}
		}
		
    }
	

	public static function DeleteUserConference($id, $user_id)
    {

    $req = ConferenceMessagesTable::getList(array('select' => array('ID', 'UF_USID', 'UF_CONFID'), 'filter' => array('ID' => $id, 'UF_USID' => $user_id)));
		
		if($row = $req->Fetch())
		{
		$row[] = $req;


		$ob = ConferenceMessagesTable::delete($row["ID"]);
		$ret = ConferenceUsersTable::getList(array('select' => array('ID', 'UF_STATUS'), 'filter' => array('UF_USID' => $row["UF_USID"], 'UF_CONFID' => $row["UF_CONFID"])));
		
		/*
		$res = array('0' => array(
		   'ID' => $row["ID"],
		   'UF_VALUE' => $row["UF_VALUE"],
		   'UF_ACCESS' => $row["UF_ACCESS"],
		   'UF_URL' => $row["UF_URl"]));
		*/
		
		if($res = $ret->fetch())
		{


		$ob2 = ConferenceUsersTable::delete($res["ID"]);
		return $ob;
		}
		}
		else return false;
    }
	
	public static function CloseUserConference($user_id)
    {

    $req = ConferenceMessagesTable::getList(array('select' => array('ID', 'UF_USID', 'UF_CONFID'), 'filter' => array('UF_USID' => $user_id)));
		
		if($row = $req->Fetch())
		{
		$row[] = $req;
		$ob = ConferenceMessagesTable::delete($row["ID"]);
		return $ob;
		}
		else return false;
    }
	
}
