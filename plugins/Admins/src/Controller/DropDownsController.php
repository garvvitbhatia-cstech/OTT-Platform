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

require_once ROOT . DS . 'vendor' . DS . 'ImageResize' . DS . 'ImageResize.php';
use Eventviva\ImageResize;
use Eventviva\ImageResizeException;

class DropDownsController extends AppController {
	
    public function changePassword() {
        $this->set('title_for_layout', 'Change Password');
        $this->loadModel('Admins.Users');
        $session = $this->getUser();
        $entity = $this->Users->findById($session['id'])->firstOrFail();
        $postData = $this->request->getData();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($entity, $postData, ['validate' => 'update']);
            if (!$user->getErrors()) {
                $hasher = new DefaultPasswordHasher();
                $user['id'] = $session['id'];
                $user['password'] = $hasher->hash($postData['new_password']);
                $user['temp'] = $this->encryptData($postData['new_password']);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The password has been updated.'));
                    return $this->redirect(['action' => 'changePassword']);
                }
            } else {
                $this->set('errors', $user->getErrors());
            }
            $this->Flash->error(__('Unable to update the password.'));
        }
        $this->set('session', $session);
        $this->set('user', null);
    }
	
    #get inner pages
    public function helpCenters() {
        $this->set('title_for_layout', 'Help Centers');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.HelpCenters');
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
            if (isset($postData['mobile']) && $postData['mobile'] != '') {
                $conditions['mobile like'] = '%' . $postData['mobile'] . '%';
            }
            if (isset($postData['status']) && $postData['status'] != '') {
                $conditions['status'] = $postData['status'];
            }
        }
        $conditions['conditions'] = $conditions;
        $conditions['order'] = ['id' => 'desc'];
        $conditions['limit'] = Configure::read('Paginate.limit');
        #get record data
        $this->paginate = $conditions;
        $pages = $this->paginate($table);
        $this->set(compact('pages'));
        $this->set('session', $session);
        $this->set('setStatus', array(1 => 'Subscriber', 2 => 'Guest'));
    }
	
	public function viewHelpCenterDetails() {
        $this->viewBuilder()->layout = false;
        $this->autoRender = false;
        if ($this->request->is('Ajax')) {
            $this->loadModel('Admins.HelpCenters');
            $postData = $this->request->getData();
            if (!empty($postData)) {
                $id = $postData['rowId'];
                $this->set(['detail' => $this->HelpCenters->findById($id)->firstOrFail()]);
                $this->render('view_details');
            }
        }
    }
	
    #get inner pages
    public function innerPages() {
        $this->set('title_for_layout', 'Inner Pages');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.InnerPages');
        # Conditions...
        $conditions = [];
        $postData = $this->request->getQuery();
        if (!empty($postData)) {
            if (isset($postData['title']) && $postData['title'] != '') {
                $conditions['title like'] = '%' . $postData['title'] . '%';
            }
            if (isset($postData['status']) && $postData['status'] != '') {
                $conditions['status'] = $postData['status'];
            }
        } //pr($conditions); die;
        $conditions['conditions'] = $conditions; //array('status !=' => 3);
        $conditions['order'] = ['title' => 'ASC'];
        $conditions['limit'] = Configure::read('Paginate.limit');
        #get record data
        $this->paginate = $conditions;
        $pages = $this->paginate($table); //pr($pages); die;
        $this->set(compact('pages'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
    }

    public function editInnerPage($editId = null) {
        #check User Auth
        $this->set('title_for_layout', 'Add Inner Page');
        $this->loadModel('Admins.InnerPages');
        $pages = $this->InnerPages->newEmptyEntity();
        if (isset($editId) && !empty($editId)) {
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit Inner Page');
            $pages = $this->InnerPages->findById($id)->firstOrFail();
            if (!isset($pages->id) && empty($pages->id)) {
                $pages = $this->InnerPages->newEmptyEntity();
            }
        }
        if ($this->request->is(['post', 'put'])) {
            $postData = $this->request->getData();
            $pages = $this->InnerPages->patchEntity($pages, $this->request->getData());
            $pages['title'] = ucwords($pages['title']);
            $pages['description'] = $pages['description'];
            $pages['heading'] = $pages['heading'];
            $pages['sub_heading'] = $pages['sub_heading'];
            $pages['banner'] = $pages['banner'];
            $pages['seo_title'] = $pages['seo_title'];
            $pages['seo_description'] = $pages['seo_description'];
            $pages['seo_keyword'] = $pages['seo_keyword'];
            $pages['robot_tags'] = $pages['robot_tags'];
            if (isset($pages['banner_status'])) {
                $pages['banner_status'] = $pages['banner_status'];
            } else {
                $pages['banner_status'] = 2;
            }
            if (isset($pages['status'])) {
                $pages['status'] = $pages['status'];
            } else {
                $pages['status'] = 2;
            }
            $pages['modified'] = time();
            if ($pages['type'] == 'Media') {
                $pages['category_id'] = implode(",", $postData['category_id']);
            }
            if ($record = $this->InnerPages->save($pages)) {
                $this->Flash->success(__('The inner page detail has been saved successfully.'));
                return $this->redirect(['action' => 'editInnerPage', base64_encode($record->id) ]);
            }
            $this->Flash->error(__('Unable to update the inner page detail.'));
        }
        $this->set('page', $pages);
        $this->set('session', $this->getUser());
    }
	
    #get inner pages
    public function packages() {
        $this->set('title_for_layout', 'Packages');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.Packages');
        # Conditions...
        $conditions = [];
        $postData = $this->request->getQuery();
        $conditions['conditions'] = $conditions;
        $conditions['order'] = ['id' => 'desc'];
        $conditions['limit'] = Configure::read('Paginate.limit');
        #get record data
        $this->paginate = $conditions;
        $packages = $this->paginate($table);
        $this->set(compact('packages'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
    }
	
    public function editPackage($editId = null) {
        #check User Auth
        $this->set('title_for_layout', 'Add Inner Page');
        $this->loadModel('Admins.Packages');
        $package = $this->Packages->newEmptyEntity();
        if (isset($editId) && !empty($editId)) {
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit Inner Page');
            $package = $this->Packages->findById($id)->firstOrFail();
            if (!isset($pages->id) && empty($pages->id)) {
                $packages = $this->Packages->newEmptyEntity();
            }
        }
        if ($this->request->is(['post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            $package['title'] = ucwords($package['title']);
            $package['discounted_price'] = $package['discounted_price'];
            $package['price'] = $package['price'];
            if (isset($package['status'])) {
                $package['status'] = $package['status'];
            } else {
                $package['status'] = 2;
            }
            $package['modified'] = time();
            if ($record = $this->Packages->save($package)) {
                $this->Flash->success(__('The package detail has been saved successfully.'));
                return $this->redirect(['action' => 'editPackage', base64_encode($record->id) ]);
            }
            $this->Flash->error(__('Unable to update the package detail.'));
        }
        $this->set('package', $package);
        $this->set('session', $this->getUser());
    }
	
	#categories page
    public function headerNavigations(){
        $this->set('title_for_layout', 'Header Navigations');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.HeaderNavigations');
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
        $navigations = $this->paginate($table);
        $this->set(compact('navigations'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
    }
	
    #add/edit member
    public function addHeaderNavigation($editId = null) {
        #check User Auth
        $this->set('title_for_layout', 'Add Header Navigation');
        $this->loadModel('Admins.HeaderNavigations');
        $navigation = $this->HeaderNavigations->newEmptyEntity();
        if(isset($editId) && !empty($editId)) {
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit Header Navigation');
            $navigation = $this->HeaderNavigations->findById($id)->firstOrFail();
            if (!isset($navigation->id) && empty($members->id)) {
                $navigation = $this->HeaderNavigations->newEmptyEntity();
            }
        }
        if ($this->request->is(['post', 'put'])) {
            $navigation = $this->HeaderNavigations->patchEntity($navigation, $this->request->getData());
			if(!isset($navigation->id) && empty($navigation->id)){
                $query = $this->HeaderNavigations->find();
                $findOrder = $query->select(array('max_order' => $query->func()->max('ordering')))->first();
                if($findOrder->max_order == ''){
                    $navigation['ordering'] = 1;
                }else{
                    $navigation['ordering'] = ($findOrder->max_order + 1);
                }
            }
            if ($record = $this->HeaderNavigations->save($navigation)) {
                $this->Flash->success(__('The header navigation detail has been saved successfully.'));
                return $this->redirect(['action' => 'addHeaderNavigation', base64_encode($record->id)]);
            }
            $this->Flash->error(__('Unable to update the header navigation detail.'));
        }
        $this->set('navigation', $navigation);
        $this->set('session', $this->getUser());
    }
	
	#categories page
    public function footerNavigations(){
        $this->set('title_for_layout', 'Footer Navigations');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.FooterNavigations');
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
        $navigations = $this->paginate($table);
        $this->set(compact('navigations'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
    }
	
    #add/edit member
    public function addFooterNavigation($editId = null) {
        #check User Auth
        $this->set('title_for_layout', 'Add Footer Navigation');
        $this->loadModel('Admins.FooterNavigations');
        $navigation = $this->FooterNavigations->newEmptyEntity();
        if(isset($editId) && !empty($editId)) {
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit Footer Navigation');
            $navigation = $this->FooterNavigations->findById($id)->firstOrFail();
            if (!isset($navigation->id) && empty($members->id)) {
                $navigation = $this->FooterNavigations->newEmptyEntity();
            }
        }
        if ($this->request->is(['post', 'put'])) {
            $navigation = $this->FooterNavigations->patchEntity($navigation, $this->request->getData());
			if(!isset($navigation->id) && empty($navigation->id)){
                $query = $this->FooterNavigations->find();
                $findOrder = $query->select(array('max_order' => $query->func()->max('ordering')))->first();
                if($findOrder->max_order == ''){
                    $navigation['ordering'] = 1;
                }else{
                    $navigation['ordering'] = ($findOrder->max_order + 1);
                }
            }
            if ($record = $this->FooterNavigations->save($navigation)) {
                $this->Flash->success(__('The footer navigation detail has been saved successfully.'));
                return $this->redirect(['action' => 'addFooterNavigation', base64_encode($record->id)]);
            }
            $this->Flash->error(__('Unable to update the footer navigation detail.'));
        }
        $this->set('navigation', $navigation);
        $this->set('session', $this->getUser());
    }
	
    #categories page
    public function members() {
        $this->set('title_for_layout', 'Team Members');
        $session = $this->getUser();
        #get content data
        $table = TableRegistry::get('Admins.Members');
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
            if (isset($postData['phone']) && $postData['phone'] != '') {
                $conditions['phone like'] = '%' . $postData['phone'] . '%';
            }
            if (isset($postData['status']) && $postData['status'] != '') {
                $conditions['status'] = $postData['status'];
            }
        } //pr($conditions); die;
        $conditions['conditions'] = $conditions; //array('status !=' => 3);
        $conditions['order'] = ['id' => 'desc'];
        $conditions['limit'] = Configure::read('Paginate.limit');
        #get record data
        $this->paginate = $conditions;
        $members = $this->paginate($table);
        $this->set(compact('members'));
        $this->set('session', $session);
        $this->set('setStatus', Configure::read('status'));
    }
	
    #add/edit member
    public function addMember($editId = null) {
        #check User Auth
        $this->set('title_for_layout', 'Add Member');
        $this->loadModel('Admins.Members');
        $members = $this->Members->newEmptyEntity();
        if (isset($editId) && !empty($editId)) {
            $id = base64_decode($editId);
            $this->set('title_for_layout', 'Edit Member');
            $members = $this->Members->findById($id)->firstOrFail();
            if (!isset($members->id) && empty($members->id)) {
                $members = $this->Members->newEmptyEntity();
            }
        }
        if ($this->request->is(['post', 'put'])) {
            $members = $this->Members->patchEntity($members, $this->request->getData());
            $members['slug'] = $this->builtSlug($members['name']);
            $members['created'] = time();
            $members['modified'] = time();
            if ($record = $this->Members->save($members)) {
                $this->Flash->success(__('The member detail has been saved successfully.'));
                return $this->redirect(['action' => 'addMember', base64_encode($record->id) ]);
            }
            $this->Flash->error(__('Unable to update the member detail.'));
        }
        $this->set('member', $members);
        $this->set('session', $this->getUser());
    }

    public function viewCategoryDetails() {
        $this->viewBuilder()->layout = false;
        $this->autoRender = false;
        if ($this->request->is('Ajax')) {
            $this->loadModel('Admins.Categories');
            $postData = $this->request->getData();
            if (!empty($postData)) {
                $id = $postData['categoryId'];
                $this->set(['categoryDetail' => $this->Categories->findById($id)->firstOrFail() ]);
                $this->render('view_category_details');
            }
        }
    }
	
    #states page
    public function products() {
        $this->set('title_for_layout', 'Products');
        $this->loadModel('Admins.Products');
        $this->loadModel('Admins.Categories');
        $conditions = [];
        $postData = $this->request->getQuery();
        if (!empty($postData)) {
            if (isset($postData['name']) && $postData['name'] != '') {
                $conditions['product_name like'] = '%' . $postData['name'] . '%';
            }
            if (isset($postData['status']) && $postData['status'] != '') {
                $conditions['status'] = $postData['status'];
            }
        }
        $this->paginate['order'] = ['category_id' => 'asc'];
        $this->paginate['limit'] = Configure::read('Paginate.limit');
        $this->paginate['conditions'] = $conditions;
        // Paginate the ORM table.
        $this->set('products', $this->paginate('Products'));
        $this->set('setStatus', Configure::read('status'));
        $this->set('session', $this->getUser());
        $this->set('allCategoryList', $this->Categories->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status =' => 1]));
    }
	
    public function addProduct($id = null) {
        $this->set('title_for_layout', 'Add Product');
        $this->loadModel('Admins.Products');
        $this->loadModel('Admins.ProductImages');
        $products = $this->Products->newEmptyEntity();
        if (isset($id) && !empty($id)) {
            $this->set('title_for_layout', 'Edit Product');
            //$id = base64_decode($id);
            $products = $this->Products->findById($id)->firstOrFail();
            if (!isset($products->id) && empty($products->id)) {
                $products = $this->Products->newEmptyEntity();
            }
            $editID = $id;
            #get row data
            $editData = $this->Products->find()->where(['id' => $editID])->first();
            if (isset($editData->id) && !empty($editData->id)) {
                $productImages = $this->ProductImages->find('all')->where(['product_id' => $editID])->order(['ordering' => 'ASC']);
                if ($productImages->count() > 0) {
                    $i = 1;
                    foreach ($productImages as $product):
                        $query = $this->ProductImages->query();
                        $query->update()->set(['ordering' => $i, 'image_alt' => ucwords($editData->product_name) . ' ' . $i, 'image_title' => ucwords($editData->product_name) . ' ' . $i, ])->where(['id' => $product->id, ])->execute();
                        $i++;
                    endforeach;
                }
                $this->set('productImages', $productImages);
            } else {
                return $this->redirect(['action' => 'products/']);
            }
        }
		
        if ($this->request->is(['post', 'put'])) {
            $postData = $this->request->getData();
            $products = $this->Products->patchEntity($products, $this->request->getData());
            $products['discount'] = 0;
            $products['video'] = $postData['video'];
            if ($record = $this->Products->save($products)) {
                if (empty($record->sku)) {
                    $sku = $this->productCode($record->product_name, $record->id);
                    $query = $this->Products->query();
                    $query->update()->set(['sku' => $sku])->where(['id' => $record->id])->execute();
                }
                if (isset($postData['ordering']) && !empty($postData['ordering'])) {
                    foreach ($postData['ordering'] as $keys => $vals):
                        $queryUpd = $this->ProductImages->query();
                        $queryUpd->update()->set(['ordering' => $vals])->where(['id' => $postData['orderingEditId'][$keys]])->execute();
                    endforeach;
                }
                $this->Flash->success(__('The product detail has been saved successfully.'));
                return $this->redirect(['action' => 'addProduct', $record->id]);
            }
            $this->Flash->error(__('Unable to update the product.'));
        }
        $this->set('CategoryList', $this->getCategoryList());
        $this->set('products', $products);
        $this->set('session', $this->getUser());
        $this->set('robotTags', Configure::read('RobotTags'));
    }
	
    public function deleteProductImage() {
        $this->viewBuilder()->setLayout('false');
        if ($this->request->is('Ajax')) {
            $postData = $this->request->getData();
            if (!empty($postData)) {
                $rowId = $postData['rowId'];
                $this->loadModel('Admins.ProductImages');
                $deleteRecord = $this->ProductImages->find()->where(['id' => $rowId])->first();
                $imageName = $deleteRecord->image_name;
                if (file_exists(WWW_ROOT . 'img/products/' . $imageName)) {
                    unlink(WWW_ROOT . 'img/products/' . $imageName);
                }
                $record = $this->ProductImages->get($rowId);
                $this->ProductImages->delete($record);
            }
        }
        exit();
    }
	
    public function uploadProductImages() {
        $this->viewBuilder()->setLayout('false');
        if ($this->request->is('Ajax')) {
            if (!empty($_FILES)) {
                $this->loadModel('Admins.ProductImages');
                $msg = "Error";
                $fileName = $_FILES['file']['name']; //Get the image
                $file_full = WWW_ROOT . 'img/products/'; //Image storage path
                $file_temp_name = $_FILES['file']['tmp_name'];
                $pathInfo = pathinfo(basename($fileName));
                $ext = $pathInfo['extension'];
                $checkImage = getimagesize($file_temp_name);
                if ($checkImage !== false) {
                    $new_file_name = date('d_m_Y_H_i_' . mt_rand(111, 999) . '_a.') . $ext;
                    if (move_uploaded_file($file_temp_name, $file_full . $new_file_name)) {
                        #### rezize image #######
                        $image = new ImageResize($file_full . $new_file_name);
                        $image->crop(500, 500);
                        $image->save($file_full . $new_file_name);
                        ######## end ############
                        $query = $this->ProductImages->findByProductId($_REQUEST['pid']);
                        //$record= $query->select(array('max_order' => $query->func()->max('ordering')))->first();
                        //if($record['max_order'] == ''){$record['max_order'] = 1;}
                        $saveData['product_id'] = $_REQUEST['pid'];
                        $saveData['image_name'] = $new_file_name;
                        $saveData['ordering'] = 0;
                        $tableEntity = $this->ProductImages->newEntity($saveData);
                        $this->ProductImages->save($tableEntity);
                        $msg = "Success";
                    }
                }
            }
            echo json_encode(['msg' => $msg]);
        }
        exit();
    }
	
    public function viewProductDetails() {
        $this->viewBuilder()->layout = false;
        $this->autoRender = false;
        if ($this->request->is('Ajax')) {
            $this->loadModel('Admins.Products');
            $this->loadModel('Admins.ProductImages');
            $postData = $this->request->getData();
            if (!empty($postData)) {
                $id = $postData['productId'];
                $this->set(['productDetail' => $this->Products->findById($id)->firstOrFail() ]);
                $this->set(['productImages' => $this->ProductImages->find('all')->where(['product_id' => $id])->order(['ordering' => 'ASC']), ]);
                $this->render('view_product_details');
            }
        }
    }
	
    public function uploadIntroVideo() {
        if (!file_exists(WWW_ROOT . 'img/categories/')) {
            mkdir(WWW_ROOT . 'img/categories/', 0777);
        }
        $dir_name = $_GET['dir_name'];
        $tmp_name = $_FILES['fileToUpload']['tmp_name'];
        $orig_file_size = filesize($tmp_name);
        $pathInfo = pathinfo(basename($_REQUEST['filename']));
        $ext = $pathInfo['extension'];
        $newFileName = $dir_name . "." . $ext;
        $target_path = WWW_ROOT . 'img/categories/' . $newFileName;
        $complete = $target_path;
        $com = fopen($complete, "ab");
        error_log($target_path);
        $in = fopen($tmp_name, "rb");
        if ($in) {
            while ($buff = fread($in, 2097152)) {
                fwrite($com, $buff);
            }
        }
        fclose($in);
        fclose($com);
        unset($target_path, $tmp_name, $size, $name, $com, $newFileName);
        flush();
        die();
    }
	
    public function uploadIntroVideoProduct() {
        if (!file_exists(WWW_ROOT . 'img/products/')) {
            mkdir(WWW_ROOT . 'img/products/', 0777);
        }
        $dir_name = $_GET['dir_name'];
        $tmp_name = $_FILES['fileToUpload']['tmp_name'];
        $orig_file_size = filesize($tmp_name);
        $pathInfo = pathinfo(basename($_REQUEST['filename']));
        $ext = $pathInfo['extension'];
        $newFileName = $dir_name . "." . $ext;
        $target_path = WWW_ROOT . 'img/products/' . $newFileName;
        $complete = $target_path;
        $com = fopen($complete, "ab");
        error_log($target_path);
        $in = fopen($tmp_name, "rb");
        if ($in) {
            while ($buff = fread($in, 2097152)) {
                fwrite($com, $buff);
            }
        }
        fclose($in);
        fclose($com);
        unset($target_path, $tmp_name, $size, $name, $com, $newFileName);
        flush();
        die();
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
}
?>
