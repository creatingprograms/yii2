<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $company;
    public $body;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, company and body are required
            [['phone'], 'required'],
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
            'company' => 'Компания',
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
            ->setReplyTo([$this->phone => $this->name])
            //->setСonfidentiality($this->confidentiality)
            ->setPhone($this->phone)
            ->setTextBody($this->body)
            ->send();
    }
}
