<?php
namespace app\models;

use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                // return \Yii::$app->mailer->compose('passwordResetToken', ['user' => $user])
                //     ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                //     ->setTo($this->email)
                //     ->setSubject('Password reset for ' . \Yii::$app->name)
                //     ->send();

//http://localhost/eventone/web/site/reset-password?token=c4psNELzGEz9yAAJqjUasMYsDcm8Z4mt_1424623364
                //send email
                $body = "<p>
Reset or change your password by clicking the link below
</p>
<p>
    <a href=\"" . (\yii\helpers\Url::toRoute('site/reset-password', true)) . "/?token=" . $user->password_reset_token . "\">Reset my password</a>.
</p>

<p>
If you have not requested for this email on our web site<br />
and believe that you have received this email eroneously,<br />
please report this to " . (Yii::$app->params['supportEmail']) . ".<br />
-----------------------------------------------------------<br />
This message was sent by " . (Yii::$app->params['siteName']) . " which is powered by " . (Yii::$app->params['companyName']) . ".<br />
</p>
                        ";

                mail($this->email, "Password Reset", $body);                
            }
        }

        return false;
    }
}
