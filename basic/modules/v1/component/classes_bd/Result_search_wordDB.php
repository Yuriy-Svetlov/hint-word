<?php
namespace app\modules\v1\component\classes_bd;

use Yii;




class Result_search_wordDB
{ 



    const TABLE_NAME = 'result_search_word';




	public static function insert($db, $hintword){

        $query = "INSERT INTO {{".self::TABLE_NAME."}} 
                
                    ([[hintword]]) 

                    VALUES

                    (:hintword)";

        return $db->createCommand($query)
                ->bindValue(':hintword', $hintword)
                ->execute();
	}




	public static function insert_transaction($db, $arr){

        $transaction = $db->beginTransaction();
        try {

            foreach ($arr as $key => $value) {
                //$value = html_entity_decode($value);
                self::insert($db, $value);
            }

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            Yii::error('Error transaction: '.$e);
            return false;
        }

        return true;
	}



}


?>