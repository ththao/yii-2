<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    const TYPE_SUPPORT             = 1;
    const TYPE_PARTNERSHIP_INQUIRY = 2;
    const TYPE_OTHER_GENERAL       = 3;

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body', 'type'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function getEmailByType()
    {
        if ($this->type == self::TYPE_SUPPORT) {
            return $type = 'support@verifysmscode.com';
        } elseif ($this->type == self::TYPE_PARTNERSHIP_INQUIRY) {
            return $type = 'admin@verifysmscode.com';
        } else {
            return $type = 'admin@verifysmscode.com';
        }
    }
    public function getType() {
        return [ 
            self::TYPE_SUPPORT             => 'Support - Technical',
            self::TYPE_PARTNERSHIP_INQUIRY => 'Partnership Inquiry',
            self::TYPE_OTHER_GENERAL       => 'Others - General',
        ];
    }

    public function getLabelType() 
    {
        if($this->type == self::TYPE_SUPPORT ) {
            return $label = 'Support - Technical';
        } elseif ($this->type == self::TYPE_PARTNERSHIP_INQUIRY) {
            return $label = 'Partnership Inquiry';
        } else {
            return $label = 'Others - General';
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose(['html' => 'contactAdmin-html', 'text' => 'contactAdmin-text'], [
                'name'    => $this->name,
                'email'   => $this->email,
                'type'    => $this->getLabelType(),
                'content' => $this->body,
            ])
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject('Contact - ' . $this->getLabelType())
                ->send();
    }

}
