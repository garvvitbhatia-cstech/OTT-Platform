<?php
namespace Admins\Controller;
use Admins\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Http\Response;
use Cake\Core\Exception\Exception;

//require_once ROOT . DS . 'vendor' . DS . 'ImageResize' . DS . 'ImageResize.php';
//use Eventviva\ImageResize;
//use Eventviva\ImageResizeException;

class CouponCodesController extends AppController{	
   	
	#categories page
    public function index(){
        $this->set('title_for_layout', 'Coupon Codes');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.CouponCodes');
        # Conditions...
        $conditions = [];
        $postData = $this->request->getQuery();
        if(!empty($postData)){
            if (isset($postData['title']) && $postData['title'] != ''){
                $conditions['title like'] = '%' . $postData['title'] . '%';
            }
            if (isset($postData['status']) && $postData['status'] != ''){
                $conditions['status'] = $postData['status'];
            }
        }
        $conditions['conditions'] = $conditions;
        $conditions['order'] = ['ordering' => 'asc'];
        $conditions['limit'] = Configure::read('Paginate.limit');
        #get record data
        $this->paginate = $conditions;
        $coupons = $this->paginate($table);
        $this->set(compact('coupons'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
    }
	
    #add/edit member
    public function addCouponCode($editId = null){
        #check User Auth
        $this->set('title_for_layout', 'Add Coupon Code');
        $table = TableRegistry::get('Admins.CouponCodes');
		$postData = $this->request->getData();
        $coupon = $this->CouponCodes->newEmptyEntity();
        if(isset($editId) && !empty($editId)){
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit Coupon Code');
            $coupon = $table->findById($id)->firstOrFail();
            if(!isset($coupon->id) && empty($coupon->id)){
                $coupon = $table->newEmptyEntity();
            }
			$coupon['modified'] = time();
        }else{
			$coupon['created'] = time();
		}
        if($this->request->is(['post', 'put'])){            
			if(isset($editId) && !empty($editId)){
				$count = $table->find()->where(['title' => trim($postData['title']), 'id !=' => $id])->all();
			}else{
				$count = $table->find()->where(['title' => trim($postData['title'])])->all();
			}
			$coupon = $table->patchEntity($coupon, $this->request->getData());
			$coupon['expiry_date'] = strtotime($coupon['expiry_date']);
			$coupon['title'] = strtoupper($coupon['title']);
			
			if($count->count() == 0){
				if($record = $this->CouponCodes->save($coupon)){
					$this->Flash->success(__('The coupon code detail has been saved successfully.'));
					return $this->redirect(['action' => 'addCouponCode',base64_encode($record->id)]);
				}
			}else{
					$this->Flash->error(__('The coupon code already exists.'));
					return $this->redirect(['action' => 'index']);	
			}
            $this->Flash->error(__('Unable to update the coupon code detail.'));
        }
        $this->set('coupon', $coupon);
        $this->set('session', $this->getUser());
		$this->set('packages',$this->getCouponCodeList());
    }
		
    #checkLoginSession
    function checkValidSession() {
        $session = $this->request->getSession();
        $nextPageUrl = $_SERVER["REQUEST_URI"];
        $session->write('nextPageUrl', $nextPageUrl);
        if (!$session->check(AUTHADMINID)) {
            return $this->redirect(ADMIN_FOLDER);
        }
    }
	
    #checkLoginSession
    function checkLoginSession() {
        $session = $this->request->getSession();
        if (!empty($session->read(AUTHADMINID))) {
            return $this->redirect(ADMIN_FOLDER . 'dashboard/');
        }
    }
	
    function getCategoryList() {
        $this->loadModel('Admins.Categories');
        return $this->Categories->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status =' => 1, 'parent_id' => 0]);
    }
	
	function getCouponCodeList(){
		$this->loadModel('Admins.Packages');
        return $this->Packages->find('list', ['keyField' => 'id', 'valueField' => 'title'])->where(['status =' => 1]);
	}
}
?>
