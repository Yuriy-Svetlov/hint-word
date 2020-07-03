<?php
namespace app\modules\cms\component\helper;

use Yii;
use app\modules\cms\component\classes_bd\Categories_relationshipsDBClass;
use app\modules\cms\component\classes_bd\PostsDBClass;
use app\modules\cms\component\classes_bd\CategoriesDBClass;
use app\modules\cms\component\classes_bd\LocaleDBClass;

use \DateTime;
use \DateTimeZone;


class HelperClass 
{ 




	/*
	Description: get time in GMT for certain location
	return: 
	*/
	public function getTimeGMT($dataTimeZone){
        $time = new DateTime("now", new DateTimeZone($dataTimeZone));
        $time->setTimestamp(time());
        return $time->format('Y-m-d H:i:s');
	}




    /*
        Check is home page or not
    */        
    public function is_HomePage($url){
        $pattern = '/^(https|http):\/\/[a-z]+\/[a-z][a-z]_[A-Z][A-Z][\/]*$/';
        return preg_match($pattern, $url);
    }



    /*
        Print error 404
    */ 
    public function error404(){
        throw new \yii\web\HttpException(404);
        exit(); 
    }











    //-------------------------------------------------------------------------
    //------------------------  Get links from [Posts] ------------------------
    //-------------------------------------------------------------------------   
    /*
    Description: get links from post
    return: array|false
    */
    public function getLinkURLPost($db, $post_id, $loc_id){

        //Get url id
        //-------------------------        
        $objPostsDB = new PostsDBClass();
        $dataPosts = $objPostsDB->getData2($db, $post_id, $loc_id);
        if(!$dataPosts){
            return false;
        }
        $url_id = $post_id . '/' . $dataPosts['url_id'];
        //-------------------------


        //Get region code
        //-------------------- 
        $objLocaleDB = new LocaleDBClass();
        $dataLocaleDB = $objLocaleDB->getRegionCode($db, $loc_id);
        if($dataLocaleDB === false){
            return false;
        } 
        $regionCode = $dataLocaleDB['lang_code'].'-'.$dataLocaleDB['region_code'];       
        //-------------------- 


        //--------------
        $objCat_relDB = new Categories_relationshipsDBClass();
        $List_Set_Categories = $objCat_relDB->getData($db, $post_id, $loc_id);

        if(count($List_Set_Categories) == 0){
            $arr[] = Yii::$app->modules['cms']->params['host-cms'].'/'.$regionCode.'/'.$url_id;
            return $arr;
        }        
        //--------------


        //--------------
        $objCategories = new CategoriesDBClass();  

        $arrCategories = [];
        foreach ($List_Set_Categories as $key => $value) {

            $arrCategories[] = Yii::$app->modules['cms']->params['host-cms'].'/'.$regionCode.'/'.$this->getLinkURLRecursive( $db, $objCategories, $value['cat_id'], $value['loc_id'], $url_id); 

        }           
        //--------------

        return $arrCategories;
    }


    private function getLinkURLRecursive($db, $objCategories, $cat_id, $loc_id, $link){

        $data = $objCategories->getData2($db, $cat_id, $loc_id);

        if($data["cat_parent"] > 0){
            $link = $data['cat_label'].'/'.$link;
            return $this->getLinkURLRecursive(  $db,
                                                $objCategories, 
                                                $data['cat_parent'], 
                                                $data['loc_id'], 
                                                $link
                                                );
        }else{
                return $data['cat_label'].'/'.$link;
        }
    }
    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------











}


?>