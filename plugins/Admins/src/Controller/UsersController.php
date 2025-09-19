<?php
declare(strict_types = 1);
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
use Cake\ORM\TableRegistry;
/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class UsersController extends AppController {
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
    public function login() { 
        //$hasher = new DefaultPasswordHasher();
        //echo $hasher->hash('Admin@2021'); die;
		
        $this->viewBuilder()->setLayout('login');
        if (!empty($this->getUser())) {
            return $this->redirect(['controller' => 'Admins', 'action' => 'dashboard']);
        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if($user){
                if ($user['status'] == 1) {
                    $this->Auth->setUser($user);
                    //$this->Flash->success(__('Login successfully.'));
					$postData = $this->request->getData();
					if(isset($postData['rememberme'])){
						setcookie('cookie_username', $postData['email'], time()+(3600*24*30*12*12), "/", "");
						setcookie('cookie_password', $postData['password'], time()+(3600*24*30*12*12), "/", "");
						setcookie('cookie_remember', $postData['rememberme'], time()+(3600*24*30*12*12), "/", "");
					}else{
						setcookie('cookie_username', '', time()-(3600*24*30*12*12), "/", "");
						setcookie('cookie_password', '', time()-(3600*24*30*12*12), "/", "");
						setcookie('cookie_remember', '', time()-(3600*24*30*12*12), "/", "");
					}
                    return $this->redirect(['controller' => 'Admins', 'action' => 'dashboard']);
                } else {
                    $this->Flash->error(__('Your account has been deactivated. Please contact to administrator.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                }
            } else {
                $this->Flash->error('Incorrect email or password!');
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
        }
		# Set cookie values....
        $cookieUserName = $cookiePassword = $cookieRemember = '';
        # Find cookie values...
        if(!empty($_COOKIE['cookie_username'])) { $cookieUserName = $_COOKIE['cookie_username'];}
        if(!empty($_COOKIE['cookie_password'])) { $cookiePassword = $_COOKIE['cookie_password'];}
        if(!empty($_COOKIE['cookie_remember'])) { $cookieRemember = $_COOKIE['cookie_remember'];}
        $this->set(compact('cookieUserName', 'cookiePassword', 'cookieRemember'));
    }
    public function logout() {
        $this->Flash->success(__('Logout successfully.'));
        $lastLogin = $this->getUser();
        $query = $this->Users->query();
        $query->update()->set(['last_login' => time() ])->where(['id' => $lastLogin['id']])->execute();
        return $this->redirect($this->Auth->logout());
    }
    public function index() {
        $this->set('title_for_layout', 'User Profile');
        $session = $this->getUser();
        $user = $this->Users->findById($session['id'])->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if (isset($user['old_image']) && !empty($user['old_image']) && $user['old_image'] != $user['profile']) {
                if (file_exists(Configure::read('Data.RelativePath') . 'user/' . $user['old_image'])) {
                    unlink(Configure::read('Data.RelativePath') . 'user/' . $user['old_image']);
                }
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The profile detail has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the user.'));
        }
        $this->set('user', $user);
        $this->set('session', $session);
    }
    public function view($id) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }
    public function registration() {
        $this->viewBuilder()->setLayout('login');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user['temp'] = $this->encryptData($_REQUEST['password']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }
    public function forgotPassword() {
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $count = $this->Users->findByEmail(trim($postData['email']))->count();
            if ($count > 0) {
                $user = $this->Users->find()->where(array('email' => trim($postData['email'])))->firstOrFail();
                $user['temp'] = $this->decryptData($user['temp']);
                // send email
                $sendEmailTo = 'User';
                $sendEmail = array('to' => $postData['email'], 'userData' => $user, 'template_id' => 1, 'template' => 'admin_forgot_password', 'sendEmailTo' => $sendEmailTo);
                $response = $this->SendEmails->sendEmail($sendEmail);
                if ($response == 'Success') {
                    $this->Flash->success(__('Password send to your register email address. Please check your email inbox.'));
                } else {
                    $this->Flash->error(__('Something went wrong. Please try again.'));
                }
            } else {
                $this->Flash->error(__('Invalid email address, please enter the correct email address.'));
            }
        }
    }
    #get inner pages
    public function users() {
        $this->set('title_for_layout', 'Users');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.Users');
        # Conditions...
        $conditions = [];
        $postData = $this->request->getQuery();
        if (!empty($postData)) {
            if (isset($postData['name']) && $postData['name'] != '') {
                $conditions['name like'] = '%' . $postData['name'] . '%';
            }
            if (isset($postData['email']) && $postData['email'] != '') {
                $conditions['email like'] = '%' . $postData['email'] . '%';
            }
            if (isset($postData['city']) && $postData['city'] != '') {
                $conditions['city like'] = '%' . $postData['city'] . '%';
            }
            if (isset($postData['status']) && $postData['status'] != '') {
                $conditions['status'] = $postData['status'];
            }
            if (isset($postData['subscription_status']) && $postData['subscription_status'] != '') {
                $conditions['subscription_status'] = $postData['subscription_status'];
            }
			if (isset($postData['is_film_maker']) && $postData['is_film_maker'] != '') {
                $conditions['is_film_maker'] = $postData['is_film_maker'];
            }
        }
        $conditions['type'] = 'User';
        $conditions['conditions'] = $conditions; //array('status !=' => 3);
        $conditions['order'] = ['id' => 'desc'];
        $conditions['limit'] = Configure::read('Paginate.limit');
        #get record data
        $this->paginate = $conditions;
        $pages = $this->paginate($table); //pr($pages); die;
        $this->set(compact('pages'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
        $this->set('freePaid', Configure::read('free_paid'));
		$this->set('yes_no', Configure::read('yes_no'));
		
		$currentDate = time();
		$this->loadModel('Users');
		$experiedUsers = $this->Users->conditionalAllRecord(array('pack_end_date <' => $currentDate));

		foreach($experiedUsers as $key => $experiedUser){
			$setData['id'] = $experiedUser->id;
			$setData['subscription_status'] = 'Free';
			$record = $this->Users->createRecord($setData);
		}
		
    }

    public function addUser($editId = null){
        #check User Auth
        $this->set('title_for_layout', 'Add User');
        $users = $this->Users->newEmptyEntity();
		$userPassword = '';
        if(isset($editId) && !empty($editId)){
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit User');
            $users = $this->Users->findById($id)->firstOrFail();
            if (!isset($users->id) && empty($users->id)) {
                $users = $this->Users->newEmptyEntity();
				$userdata['created'] = time();
            }
			$userPassword = $this->decryptData($users->password);
        }
        if($this->request->is(['post', 'put'])){
            $userdata = $this->Users->patchEntity($users, $this->request->getData());
			if (isset($userdata['old_image']) && !empty($userdata['old_image']) && $userdata['old_image'] != $userdata['profile']) {
                if (file_exists(Configure::read('Data.RelativePath') . 'user/' . $userdata['old_image'])) {
                    unlink(Configure::read('Data.RelativePath') . 'user/' . $userdata['old_image']);
                }
			}
			$userdata['type'] = 'User';
			if($userdata->temp != ""){
				$userdata['password'] = $this->encryptData($userdata->temp);
			}
			$userdata['temp'] = NULL;
            $userdata['modified'] = time();

            if($record = $this->Users->save($userdata)){
                //$this->Flash->success(__('The user detail has been saved successfully.'));
                return $this->redirect(['action' => 'users']);
            }
            $this->Flash->error(__('Unable to update the user detail.'));
        }
        $this->set('user', $users);
		$this->set('userPassword', $userPassword);
        $this->set('session', $this->getUser());
    }
	
	#get inner pages
    public function subAdmins(){
        $this->set('title_for_layout', 'Users');
        $session = $this->getUser();
		if($session['type'] == 'SubAdmin'){
			return $this->redirect(['action' => 'dashboard']);				
		}
        #get content data
        $table = TableRegistry::get('Admins.Users');
        # Conditions...
        $conditions = [];
        $postData = $this->request->getQuery();
        if (!empty($postData)) {
            if (isset($postData['name']) && $postData['name'] != '') {
                $conditions['name like'] = '%' . $postData['name'] . '%';
            }
            if (isset($postData['email']) && $postData['email'] != '') {
                $conditions['email like'] = '%' . $postData['email'] . '%';
            }
            if (isset($postData['city']) && $postData['city'] != '') {
                $conditions['city like'] = '%' . $postData['city'] . '%';
            }
            if (isset($postData['status']) && $postData['status'] != '') {
                $conditions['status'] = $postData['status'];
            }
            if (isset($postData['subscription_status']) && $postData['subscription_status'] != '') {
                $conditions['subscription_status'] = $postData['subscription_status'];
            }
        }
        $conditions['type'] = 'SubAdmin';
        $conditions['conditions'] = $conditions; //array('status !=' => 3);
        $conditions['order'] = ['id' => 'desc'];
        $conditions['limit'] = Configure::read('Paginate.limit');
        #get record data
        $this->paginate = $conditions;
        $pages = $this->paginate($table); //pr($pages); die;
        $this->set(compact('pages'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
        $this->set('freePaid', Configure::read('free_paid'));
    }

    public function addSubAdmin($editId = NULL){
        #check User Auth
        $this->set('title_for_layout', 'Add User');
		$session = $this->getUser();
		if($session['type'] == 'SubAdmin'){
			return $this->redirect(['action' => 'dashboard']);				
		}
        $users = $this->Users->newEmptyEntity();
		$userPassword = '';
        if(isset($editId) && !empty($editId)){
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit User');
            $users = $this->Users->findById($id)->firstOrFail();
            if(!isset($users->id) && empty($users->id)){
                $users = $this->Users->newEmptyEntity();
				$userdata['created'] = time();
            }
			$userPassword = $this->decryptData($users->temp);
        }
        if($this->request->is(['post', 'put'])){
			$postData = $this->request->getData();
			$hasher = new DefaultPasswordHasher();        	
            $userdata = $this->Users->patchEntity($users, $postData);
			if (isset($userdata['old_image']) && !empty($userdata['old_image']) && $userdata['old_image'] != $userdata['profile']) {
                if (file_exists(Configure::read('Data.RelativePath') . 'user/' . $userdata['old_image'])) {
                    unlink(Configure::read('Data.RelativePath') . 'user/' . $userdata['old_image']);
                }
			}
			if(!isset($userdata->id) && empty($userdata->id)) {
				$userdata['created'] = time();
			}
			
			$userdata['type'] = 'SubAdmin';
			$userdata['temp'] = $this->encryptData($postData['temp']);
			$userdata['password'] = $hasher->hash($postData['temp']);			
            $userdata['modified'] = time();
            if($record = $this->Users->save($userdata)){
                //$this->Flash->success(__('The user detail has been saved successfully.'));
                return $this->redirect(['action' => 'sub-admins']);
            }
            $this->Flash->error(__('Unable to update the admin detail.'));
        } 
        $this->set('user', $users);
		$this->set('userPassword', $userPassword);
        $this->set('session', $this->getUser());
    }

}
?>
