<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $password;
    public $repeat_password;
    public $phone;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
//            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['phone', 'first_name', 'middle_name', 'last_name'], 'string'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['password', 'repeat_password'], 'required'],
            [['password', 'repeat_password'], 'string', 'min' => 6],
            ['password', 'compare', 'compareAttribute'=>'repeat_password'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->first_name = $this->first_name;
        $user->middle_name = $this->middle_name;
        $user->last_name = $this->last_name;
        $user->phone = $this->phone;
        $user->status = 1;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Телефон',
            'password' => 'Придумайте пароль (не менее 8 символов)',
            'repeat_password' => 'Повторите пароль'
        ];
    }
}
