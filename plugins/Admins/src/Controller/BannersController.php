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



require_once(ROOT . DS  . 'vendor' . DS  . 'ImageResize' . DS . 'ImageResize.php');

use Eventviva\ImageResize;

use Eventviva\ImageResizeException;



class BannersController extends AppController{


    public function banners(){

        $this->set('title_for_layout', 'Banners');

		$this->loadModel('Admins.Banners');				

		$conditions = array();

		$postData = $this->request->getQuery();

		if(!empty($postData)){
			
			if(isset($postData['status']) && $postData['status'] !=''){

				$conditions['status'] = $postData['status'];

			}
			if(isset($postData['type']) && $postData['type'] !=''){

				$conditions['type'] = $postData['type'];

			}

		}		

		$this->paginate['order'] = array('ordering'=>'asc');

		$this->paginate['limit'] = Configure::read('Paginate.limit');

		$this->paginate['conditions'] = $conditions;

	

		// Paginate the ORM table.

		$this->set('banners', $this->paginate('banners'));

		$this->set('setStatus', Configure::read('status'));
		$this->set('type', array('Custom' => 'Custom', 'Media' => 'Video'));

		$this->set('session',$this->getUser());

    }

	

	#edit Category

    public function addBanner($id=NULL){

        #check User Auth
		$this->set('title_for_layout', 'Add Banner');
		$this->loadModel('Admins.Banners');		
		$banners = $this->Banners->newEmptyEntity();
		if(isset($id) && !empty($id)){

			$this->set('title_for_layout', 'Edit Banner');
			//$id = base64_decode($id);
			$banners = $this->Banners->findById($id)->firstOrFail();
			if(!isset($banners->id) && empty($banners->id)){
				$banners = $this->Banners->newEmptyEntity();
			}
		}

		if($this->request->is(['post', 'put'])){
			$banner = $this->Banners->patchEntity($banners, $this->request->getData());
			if(!isset($banners->id) && empty($banners->id)){
                $query = $this->Banners->find();
                $findOrder = $query->select(array('max_order' => $query->func()->max('ordering')))->first();
                if($findOrder->max_order == ''){
                    $banner['ordering'] = 1;
                } else {
                    $banner['ordering'] = ($findOrder->max_order + 1);
                }
            }
			if(!isset($banner->id) && empty($banner->id)){
				$banner['created'] = time();
			}else{
				$banner['modified'] = time();
			}			
			if(isset($banner['old_image']) && !empty($banner['old_image']) && $banner['old_image'] != $banner['banner']){
				if(file_exists(Configure::read('Data.RelativePath').'banners/'.$banner['old_image'])){
					unlink(Configure::read('Data.RelativePath').'banners/'.$banner['old_image']);
				}
			}
			if($record = $this->Banners->save($banner)){
				$this->Flash->success(__('The banner detail has been saved successfully.'));
				return $this->redirect(['action' => 'addBanner',$record->id]);
			}
			$this->Flash->error(__('Unable to update the banner.'));
		}
		$this->set('banners',$banners);
		$this->set('session',$this->getUser());

    }

	

	public function viewBannerDetails(){

		$this->viewBuilder()->layout = false;

		$this->autoRender = false;

		if($this->request->is('Ajax')){

			$this->loadModel('Admins.Banners');

			$postData = $this->request->getData();

			if(!empty($postData)){

				$id = $postData['bannerId'];

				$this->set(array('bannerDetail'=>$this->Banners->findById($id)->firstOrFail()));

				$this->render('view_banner_details');

			}

		}	

	}
	
	public function footerApps(){

        $this->set('title_for_layout', 'Footer Apps');
		$this->loadModel('Admins.FooterApps');		

		$conditions = array();

		$postData = $this->request->getQuery();

		if(!empty($postData)){
			
			if(isset($postData['status']) && $postData['status'] !=''){

				$conditions['status'] = $postData['status'];

			}
			
			if(isset($postData['type']) && $postData['type'] !=''){

				$conditions['type'] = $postData['type'];

			}

		}		
		$this->paginate['order'] = array('ordering'=>'asc');
		$this->paginate['limit'] = Configure::read('Paginate.limit');
		$this->paginate['conditions'] = $conditions;

		// Paginate the ORM table.
		$this->set('footerApps', $this->paginate('footer_apps'));
		$this->set('setStatus', Configure::read('status'));
		$this->set('session',$this->getUser());

    }

	

	#edit Category

    public function addFooterApp($id=NULL){

        #check User Auth
		$this->set('title_for_layout', 'Add Footer App');
		$this->loadModel('Admins.FooterApps');		
		$banners = $this->FooterApps->newEmptyEntity();
		if(isset($id) && !empty($id)){
			$this->set('title_for_layout', 'Edit FooterApp');
			//$id = base64_decode($id);
			$banners = $this->FooterApps->findById($id)->firstOrFail();
			if(!isset($banners->id) && empty($banners->id)){
				$banners = $this->FooterApps->newEmptyEntity();
			}
		}

		if($this->request->is(['post', 'put'])){
			$banner = $this->FooterApps->patchEntity($banners, $this->request->getData());
			if(!isset($banners->id) && empty($banners->id)){
				$banner['created'] = time();
                $query = $this->FooterApps->find();
                $findOrder = $query->select(array('max_order' => $query->func()->max('ordering')))->first();
                if($findOrder->max_order == ''){
                    $banner['ordering'] = 1;
                } else {
                    $banner['ordering'] = ($findOrder->max_order + 1);
                }
            }else{
				$banner['modified'] = time();
			}			
			if(isset($banner['old_image']) && !empty($banner['old_image']) && $banner['old_image'] != $banner['icon']){
				if(file_exists(Configure::read('Data.RelativePath').'banners/'.$banner['old_image'])){
					unlink(Configure::read('Data.RelativePath').'banners/'.$banner['old_image']);
				}
			}
			if($record = $this->FooterApps->save($banner)){
				$this->Flash->success(__('The footer apps detail has been saved successfully.'));
				return $this->redirect(['action' => 'addFooterApp',$record->id]);
			}
			$this->Flash->error(__('Unable to update the footer app.'));
		}
		$this->set('apps',$banners);
		$this->set('session',$this->getUser());

    }



    #checkLoginSession

    function checkValidSession(){

        $session = $this->request->getSession();

		$nextPageUrl = $_SERVER["REQUEST_URI"];

		$session->write('nextPageUrl',$nextPageUrl);

        if(!$session->check(AUTHADMINID)){

            return $this->redirect(ADMIN_FOLDER);

        }

    }



    #checkLoginSession

    function checkLoginSession(){

        $session = $this->request->getSession();

        if(!empty($session->read(AUTHADMINID))){

            return $this->redirect(ADMIN_FOLDER.'dashboard/');

        }

    }


}

?>