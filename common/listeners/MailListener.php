<?php
/**
 * @author Bryan Tan <bryantan16@gmail.com>
 */

namespace common\listeners;

use common\events\ResetPasswordEvent;
use Yii;
use yii\helpers\VarDumper;

class MailListener
{
    public function resetPassword(ResetPasswordEvent $event)
    {
        /** @var $sendGrid \bryglen\sendgrid\Mailer */
        $sendGrid = Yii::$app->sendGrid;
        $message = $sendGrid->compose('reset-password', ['user' => $event->user, 'new_password' => $event->new_password]);
        $message->setFrom(Yii::$app->params['noreplyEmail']);
        $message->setTo($event->user->email);
        $message->setSubject(sprintf('[%s] %s', Yii::$app->name, 'Change Password'));

        if ($message->send($sendGrid)) {
            return true;
        } else {
            $errors = $sendGrid->getErrors();
            Yii::error(sprintf("Error in SendGridMail %s.%s: ", __CLASS__, __FUNCTION__, VarDumper::dumpAsString($errors)));
            return false;
        }
    }
}