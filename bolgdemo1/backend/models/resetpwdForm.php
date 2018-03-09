<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;

/**
 * Signup form
 */
class resetpwdForm extends Model
{

    public $password;
    public $password_repeat;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password','message'=>'两次输入密码不一致'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'password_repeat'=>'再次输入密码',

        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = Adminuser::findone($id);
        $user->password=$this->password;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        
        return $user->save() ? $user : null;
    }
}
