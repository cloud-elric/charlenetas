<?php
namespace app\modules\modAdminPanel\components;

use app\modules\ModUsuarios\models\EntUsuarios;
class AccessRule extends \yii\filters\AccessRule {

	/**
	 * @inheritdoc
	 */
	protected function matchRole($user)
	{
		if (empty($this->roles)) {
			return true;
		}
		foreach ($this->roles as $role) {
			if ($role == '?') {
				if ($user->getIsGuest()) {
					return true;
				}
			} elseif ($role == EntUsuarios::ROLE_CHARLENAUTA) {
				if (!$user->getIsGuest()) {
					return true;
				}
				// Check if the user is logged in, and the roles match
			} elseif (!$user->getIsGuest() && $role == $user->identity->id_tipo_usuario) {
				return true;
			}
		}

		return false;
	}
}