<?php
namespace app\modules\cms\component\locale;


use Yii;

use app\modules\cms\models\db_table\Locale;
use \DateTime;
use \DateTimeZone;


class LocaleSiteClass 
{ 


    /*
    	Get time zone site in format [Europe/Moscow]
    */		
	public function getDataTimeZone($loc_id){
		$data = Locale::find()
			->select(['date_time_zone'])
			->where(['loc_id' => $loc_id])
			->limit(1)
			->one();

        if($data !== null){
            return $data->date_time_zone;
        }
		return false;
	}	


    /*
    	Get time for site, in format GMT
    */		
	public function getTimeGMT($loc_id){
		$dataTimeZone = $this->getDataTimeZone($loc_id);
		$time = new DateTime("now", new DateTimeZone($dataTimeZone));
		$time->setTimestamp(time());
		return $time->format('Y-m-d H:i:s');
	}




}


?>