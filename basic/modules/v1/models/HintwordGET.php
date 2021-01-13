<?php
namespace app\modules\v1\models;

use Yii;
use yii\base\Model;
use app\modules\v1\component\classes_bd\Log_userDB;
use app\modules\v1\component\classes_bd\Result_search_wordDB;

class HintwordGET extends Model
{
    public $word;
    public $ip;
    

    public function init()
    {   
        $this->ip = \Yii::$app->getRequest()->getUserIP();
    }


    public function rules()
    {
        return [
            ['word', 'required'],

            ['word', 'match', 'pattern' => '/^[\w ]+$/iu', 'message' => 'Invalid character'],

            ['word', 'string', 'length' => [4, 250]],

            ['ip', 'ip'],
        ];
    }


    private function getHintWordGoogle(){
        $curl = curl_init();
        $word = urlencode($this->word);

        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/complete/search?q='.$word.'&cp=5&client=psy-ab&xssi=t&gs_ri=gws-wiz&hl=ru-UA&authuser=0&pq=Get%20%D1%81%D0%B5%D1%80%D0%B2%D0%B8%D1%81%20%D0%BF%D0%BE%D0%B4%D1%81%D0%BA%D0%B0%D0%B7%D0%BE%D0%BA%20Google&psi=7NH-Xv_sLqOMrwSsiJIw.1593758187794&ei=7NH-Xv_sLqOMrwSsiJIw&gs_mss=hello7');

        //curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 5);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);


        if($httpcode === 200 && $result != ""){
            $result = str_replace(')]}\'','', $result);
            $result = json_decode($result);
            
            return $this->getArrHintWord($result[0]);
        }

         return false;
    }


    private function getArrHintWord(array $arr): array{
        $arr_res = [];

        for ($i=0; $i < count($arr); $i++) { 
            if($i > 6){
                return $arr_res;
            }

            if(is_array($arr[$i]) === false){
                return $arr_res;
            }

            if(is_string($arr[$i][0]) === false){
                return $arr_res;
            }

            $arr_res[] = strip_tags($arr[$i][0]);
        }

        return $arr_res;
    }


    public function getData(){
        $hintword_arr = $this->getHintWordGoogle();
        if(!is_array($hintword_arr)){
            $hintword_arr = [];
        }

        $db = Yii::$app->db;

        Log_userDB::insert($db, $this->word, $this->ip);
        Result_search_wordDB::insert_transaction($db, $hintword_arr);

        //return $hintword_arr;
        return $this->dataResponse($hintword_arr, 200);
    }


    private function dataResponse($data = NULL, $status = 200, $error = NULL){
        return json_encode([
            "data" => $data,            
            "status" => $status,
            "error" => $error,            
        ]);
    }


    public static function html_sanitize(string $str): string
    {
       return htmlspecialchars(strip_tags($str), ENT_QUOTES | ENT_HTML5, "UTF-8");   
    }

}