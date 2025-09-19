<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Admins\Controller;
use Admins\Controller\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Auth\DefaultPasswordHasher; // Add this line
use Cake\Utility\Security; // Add this line

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class AdminsController extends AppController{
    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
	 
	public function initialize(): void{
        parent::initialize();
			
	}
	
	public function dashboard(){	
		$this->set('title_for_layout', 'Dashboard');
		$session = $this->getUser();
		$this->set('session',$session);
	}
	
	public function siteConfiguration(){	
		$this->set('title_for_layout', 'Site Configuration');
		$this->loadModel('Admins.Settings');
		$session = $this->getUser();
		$setting = $this->Settings->findById(1)->firstOrFail();
		$postData = $this->request->getData();		
		if($this->request->is(['post','put'])){
			$user = $this->Settings->patchEntity($setting,$postData, ['validate'=>'updatesiteconfig']);
			if(isset($user['old_image']) && !empty($user['old_image']) && $user['old_image'] != $user['logo']){				
				if(file_exists(Configure::read('Data.RelativePath').'logo/'.$user['old_image'])){				
					unlink(Configure::read('Data.RelativePath').'logo/'.$user['old_image']);
				}				
			}
			if($this->Settings->save($user)){
				$this->Flash->success(__('The site configuration detail has been updated successfully.'));
				return $this->redirect(['action' => 'siteConfiguration']);
			}
			$this->Flash->error(__('Unable to update the site-configuration details.'));
		}
		$this->set('session',$session);
		$this->set('setting',$setting);
	}
	
	public function changePassword(){
		$this->set('title_for_layout', 'Change Password');
		$this->loadModel('Admins.Users');
		$session = $this->getUser();
		$entity = $this->Users->findById($session['id'])->firstOrFail();
		$postData = $this->request->getData();
		if($this->request->is('post')){			
			$user = $this->Users->patchEntity($entity,$postData, ['validate'=>'update']);
			if(!$user->getErrors()){
				$hasher = new DefaultPasswordHasher();
				$user['id'] = $session['id'];
				$user['password'] = $hasher->hash($postData['new_password']);
				$user['temp'] = $this->encryptData($postData['new_password']);
				if($this->Users->save($user)){
					$this->Flash->success(__('The password has been updated.'));
					return $this->redirect(['action' => 'changePassword']);
				}
			}else{
				$this->set('errors',$user->getErrors());
			}
			$this->Flash->error(__('Unable to update the password.'));
		}
		$this->set('session',$session);
		$this->set('user',NULL);
	}
	
	public function checkPassword(){
		$this->viewBuilder()->layout = false;
		$this->autoRender = false;
		if($this->request->is('Ajax')){
			$this->loadModel('Admins.Users');
			$session = $this->getUser();
			$postData = $this->request->getData();
			if(!empty($postData)){
				$passChk = 'NotMatch';
				$user = $this->Users->findById($session['id'])->firstOrFail();
				if((new DefaultPasswordHasher)->check($postData['password'], $user['password'])){
					$passChk = 'Authenticate';
				}
			}
			echo json_encode(array('msg'=>$passChk));
		}
		exit;
	}
	
	public function footer() {
            $this->set('title_for_layout', 'Footer');
            $this->loadModel('Admins.Footer');
			$this->loadModel('Admins.FooterApps');
            $session = $this->getUser();
            $footer = $this->Footer->findById(1)->firstOrFail();			
			
            $postData = $this->request->getData();			
            if($this->request->is(['post', 'put'])){
                $footerContent = $this->Footer->patchEntity($footer, $postData, ['validate' => 'updatefootercontent']);
                if(isset($user['old_image']) && !empty($footerContent['old_image']) && $footerContent['old_image'] != $footerContent['footer_logo']){
                    if(file_exists(Configure::read('Data.RelativePath') . 'logo/' . $footerContent['old_image'])){
                        unlink(Configure::read('Data.RelativePath') . 'logo/' . $footerContent['old_image']);
                    }
                }
				
                $this->Footer->save($footerContent);			
				$this->Flash->success(__('The footer detail has been updated successfully.'));
				return $this->redirect(['action' => 'footer']);
			}				
			$this->set('session', $session);
			$this->set('footer', $footer);
        }
	
}

?>