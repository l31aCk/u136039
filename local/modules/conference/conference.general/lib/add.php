<?php
namespace CONFERENCE\GENERAL;
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






class GENERALConference {

    public static function DateIntval($day, $month, $year) {
        if(!$day || !$month || !$year) {
            return array();
        }

        //Добавляем значения
        $day = intval($day);
        $month = intval($month);
        $year = intval($year);
		
		$date = $day . '.' . $month . '.' . $year;
		
		
        //Делаем запрос в БД и возвращаем ответ
        return $date;

    }

    //Компонент conference.menu.create
    public static function AddConference($topic, $place, $date) {
        if(!$topic || !$place || !$date ) {
            return array();
        }


        //Добавляем значения
        $arValue = array(
           'UF_TOPIC' => $topic,
           'UF_PLACE' => $place,
		   'UF_DATE' =>  new
                \Bitrix\Main\Type\DateTime(date($date) . ' 00:00:00')
        );

        //Делаем запрос в БД и возвращаем ответ
        return ConferenceTable::add($arValue);

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
