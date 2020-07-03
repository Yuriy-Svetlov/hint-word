<?php
namespace app\modules\v1\controllers;

use yii\web\Controller;
use yii;
use app\modules\v1\models\HintwordGET;



class HintwordController extends Controller
{




    public function actionIndex()
    {   

        //GET    
        if(Yii::$app->request->isGet){

	        $model = new HintwordGET();
	        $model->word = Yii::$app->request->get('word');

	        if($model->validate()){
	            return $model->getData();
	        }

	        return $model->errorValidate();
    	}


    }



}
