<?php

namespace app\modules\ModUsuarios\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *          
 */
class LoginForm extends Model {
	public $username;
	public $password;
	public $rememberMe = true;
	public $userEncontrado;
	private $_user = false;
	
	/**
	 *
	 * @return array the validation rules.
	 */
	public function rules() {
		return [
				// username and password are both required
				[ 
						[ 
								'username',
								'password' 
						],
						'required',
						'on' => 'login',
						'message'=>'Campo requerido'
				],
				// username es requerido para recuperar la contraseña
				[ 
						[ 
								'username' 
						],
						'required',
						'on' => 'recovery',
						'message' => 'Campo requerido'
				],
				[ 
						[ 
								'username' 
						],
						'validateUsuario',
						'on' => 'recovery' 
				],
				[ 
						[ 
								'username' 
						],
						'trim' 
				],
				['username','email','message'=>'Ingrese una dirección de correo valida'],
				
				// rememberMe must be a boolean value
				[ 
						'rememberMe',
						'boolean' 
				],
				// password is validated by validatePassword()
				[ 
						'password',
						'validatePassword',
						'on' => 'login' 
				] 
		];
	}
	
	public function attributeLabels() {
		return ['username'=>'Dirección de correo',
				'password'=>'Contraseña'
		];
	}
	
	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute
	 *        	the attribute currently being validated
	 * @param array $params
	 *        	the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params) {
		if (! $this->hasErrors ()) {
			$user = $this->getUserByEmail ();
			
			if (! $user || ! $user->validatePassword ( $this->password )) {
				$this->addError ( $attribute, 'Usuario y/o contraseña incorrectos.' );
			}else if($user->id_status == EntUsuarios::STATUS_PENDIENTED){
				$this->addError ( $attribute, 'Para ingresar debe activar su cuenta.' );
			}
		}
	}
	
	/**
	 * Valida que el usuario exista
	 */
	public function validateUsuario($attribute, $params) {
		$this->userEncontrado = $this->getUserByEmail ();
		
		if (empty($this->userEncontrado)) {
			$this->addError ( $attribute, 'No existe una cuenta asociada al correo electronico ingresado.' );
		}
	}
	
	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login() {
		if ($this->validate ()) {
			
			
			
			return Yii::$app->user->login ( $this->getUserByEmail (), 360000 * 24 * 30 );
		}
		return false;
	}
	
	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser() {
		if ($this->_user === false) {
			$this->_user = EntUsuarios::findByEmail ( $this->username );
			
		}
		
		return $this->_user;
	}
	
	public function getUserByEmail() {
		if ($this->_user === false) {
			$this->_user = EntUsuarios::findUser( $this->username );
				
		}
	
		return $this->_user;
	}
}
