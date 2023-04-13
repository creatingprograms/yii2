<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CalcForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $body;
    public $verifyCode;
    public $confidentiality;
    public $nabor1;
    public $nabor2;
    public $nabor3;
    public $nabor4;
    public $nabor5;
    public $nabor6;
    public $nabor7;
    public $nabor8;
    public $nabor9;
    public $nabor10;
    public $nabor11;
    public $upload_image;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'phone', 'confidentiality'], 'required'],
            [['nabor1', 'nabor2', 'nabor3', 'nabor4', 'nabor5', 'nabor6', 'nabor7', 'nabor8', 'nabor9', 'nabor10', 'nabor11', 'imageFile', 'upload_image'], 'safe'],
            [['confidentiality',], 'boolean'],
            [['confidentiality'], 'compare', 'compareValue' => 1, 'message' => 'Выствите чебокс, иначе форма не отправится!'],
            // email has to be a valid email address
            //['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'body' => 'Текст письма',
            'confidentiality' => 'Конфиденциальность'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([Yii::$app->params['senderEmail'] => $this->name])
            //->setСonfidentiality($this->confidentiality)
            //->setPhone($this->phone)
            ->setTextBody($this->name)
            ->setHtmlBody('<b>'.$this->name.'</b><p>'.$this->phone.'</p><p>'.$this->nabor1.'</p>')
            ->send();
    }
}
