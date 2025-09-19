<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Mailer;
use Cake\Core\Exception\Exception;
class SendEmailsComponent extends Component{

	#send Emails
	public function sendEmail($sendEmailData) {
		// send email notification
		$emailtable = TableRegistry::get('EmailTemplates');
		$emailTemplate = $emailtable->find()->where(array('EmailTemplates.id' => $sendEmailData['template_id']))->first();
		$sendToUser = 'Admin';
		if(isset($sendEmailData['sendEmailTo']) && $sendEmailData['sendEmailTo'] != 'Admin'){
			$sendToUser = $sendEmailData['sendEmailTo'];
			$this->sendEmailData($sendEmailData);
		}
		if(!isset($sendEmailData['sendEmailTo'])){
			$this->sendEmailData($sendEmailData);
		}
		#send  Email to Admins
		if(isset($emailTemplate->email_template_email_address) && !empty($emailTemplate->email_template_email_address) && $sendToUser != 'UserOnly'){
			$adminEmails = explode('||',$emailTemplate->email_template_email_address);
			if(count($adminEmails) > 0){
				foreach($adminEmails as $adminEmail){
					$sendEmailData['sendEmailTo'] = 'Admin';
					$sendEmailData['to'] = $adminEmail;
					if(trim($adminEmail) !='' && (filter_var($adminEmail, FILTER_VALIDATE_EMAIL))){
						$this->sendEmailData($sendEmailData);
					}
				}
			}
		}
		return 'Success';
	}
	function sendEmailData($sendEmailData){
		$returnMsg = 'EmailNotSend';
		#get email template data
		$emailtable = TableRegistry::get('EmailTemplates');
		$emailTemplate = $emailtable->find()->where(array('EmailTemplates.id' => $sendEmailData['template_id']))->first();
		#get site configuration data
		$sitetable = TableRegistry::get('Users');
		$siteConfiguration = $sitetable->find()->where(array('id' => 1))->first();
		if(isset($emailTemplate->email_template_status) && $emailTemplate->email_template_status == 1){
			try{
				$mailer = new Mailer();
				$mailer
				->setEmailFormat('html')
				->setTo($sendEmailData['to'])
				->setSubject($emailTemplate->email_template_subject)
				->setFrom([ $emailTemplate->email_template_sender_email_address => $emailTemplate->email_template_sender_name])
				->set(compact('emailTemplate','siteConfiguration','sendEmailData'))
				->viewBuilder()
				->setTemplate($sendEmailData['template']);
				$mailer->deliver();				
				$returnMsg =  'Success';
			}catch( \MissingTemplateException $e){
				$returnMsg = 'EmailNotSend';
			}catch( \SocketException $e){
				$returnMsg = 'EmailNotSend';
			}catch( \Exception $e){
				$returnMsg = 'EmailNotSend';
			}
			return $returnMsg;
		}
	}
}
?>
