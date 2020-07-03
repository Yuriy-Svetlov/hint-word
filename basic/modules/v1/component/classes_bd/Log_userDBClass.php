<?php
namespace app\modules\v1\component\classes_bd;

use Yii;




class Log_userDBClass 
{ 



    const TABLE_NAME = 'log_user';




	public static function insert($db, $word, $ip){

        $query = "INSERT INTO {{".self::TABLE_NAME."}} 
                
                    ([[word]], [[date]], [[ip]]) 

                    VALUES

                    (:word, :date, :ip)";

        return $db->createCommand($query)
                ->bindValue(':word', $word)
                ->bindValue(':date', date("Y-m-d H:i:s"))
                ->bindValue(':ip', $ip)
                ->execute();
	}




}


?>