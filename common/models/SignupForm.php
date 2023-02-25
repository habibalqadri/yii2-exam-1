<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\bootstrap4\Html;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    // public $repeat_password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            // ['password', 'required'],

            // ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            //lanjut
            // ['password, repeat_password', 'required', 'on' => 'insert'],
            // ['password, repeat_password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            // ['password', 'compare', 'compareAttribute' => 'repeat_password'],



            // ['password', 'compare', 'compareAttribute' => 'repeat_password']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
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
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $this->beforeSave();
        $this->afterFind();
        // $this->saveModel($user);

        return
            $this->saveModel($user) && $this->sendEmail($user);
    }

    public function beforeSave()
    {
        // in this case, we will use the old hashed password.
        if (empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword))
            $this->password = $this->repeat_password = $this->initialPassword;

        return parent::beforeSave();
    }

    public function afterFind()
    {
        //reset the password to null because we don't want the hash to be shown.
        $this->initialPassword = $this->password;
        $this->password = null;

        parent::afterFind();
    }

    public function saveModel($data = array())
    {
        //because the hashes needs to match
        if (!empty($data['password']) && !empty($data['repeat_password'])) {
            $data['password'] = Yii::$app->user->hashPassword($data['password']);
            $data['repeat_password'] = Yii::$app->user->hashPassword($data['repeat_password']);
        }

        $this->attributes = $data;

        if (!$this->save())
            return Html::errorSummary($this);

        return true;
    }





    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
