<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use vendor\facebook\FacebookI;
use app\models\Pagos;
use app\models\Utils;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

   /**
    * 
    */
    public function actionGenerarTicketOpenPay(){
    	$this->layout = false;
    	$data = $this->generarOrdenCompraOpenPay();
    	
    	return $this->render('openPay',[]);
    }
    
    private function generarOrdenCompraOpenPay(){
    	$pago = new Pagos();
    	$orderId = Utils::generateToken('odc');
    	return $pago->oPCodeBar('descripcion del producto', $orderId, 200);
    }
    
    private function generarOrdenCompraPayPal(){
    	
    }
}
