<?php
namespace app\modules\v1\controllers;


use yii\rest\Controller;
use yii;
use app\modules\v1\models\HintwordGET;


class HintwordController extends Controller
{

    public function behaviors() {
      return [
          'verbs' => [
              'class' => \yii\filters\VerbFilter::className(),
              'actions' => [
                  'index'  => ['GET'],
                  'view'   => ['GET'],
                  'create' => ['GET', 'POST'],
                  'update' => ['GET', 'PUT', 'POST'],
                  'delete' => ['POST', 'DELETE'],
              ],
          ],         
          [
            'class' => \yii\filters\ContentNegotiator::className(),
            'only' => ['index'],
            'formats' => [
              'application/json' => \yii\web\Response::FORMAT_JSON,
            ],         
          ],
      ];
    }


    public function actionIndex()
    {   
        $model = new HintwordGET();
        $model->word = Yii::$app->request->get('word');

        if($model->validate()){
	        // Response - Not found
	        //throw new NotFoundHttpException(
	        //      'Object not found: ' . $model->id, 0
	        //);         	
            return $model->getData();
        }

		// Response - error of validation
		// ------------------------------
		if ($model->hasErrors()) {
		  Yii::$app->response->setStatusCode(422, 'Data Validation Failed.');
		  
		  $errors = [];
		  foreach ($model->getErrors() as $key => $value) {
		      $errors[] = ["field" => $key, "message" => $value[0]];
		  } 

		  return $errors;
		}  
		// ------------------------------
    }

}
