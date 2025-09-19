<?php $action = $this->request->getParam('action');?>
<nav class="navbar-default navbar-side" role="navigation">
   <div class="sidebar-collapse">
      <ul class="nav" id="main-menu">
         <li class="text-center">
         	<?php
				$active = '';
				$admin = $this->Admin->getAdminData($session['id']);
				if(isset($admin['profile']) && !empty($admin['profile'])){
					if(file_exists(WWW_ROOT.'img/user/'.$admin['profile'])){
						echo $this->Html->image('user/'.$admin['profile'], [
							'alt'=>$admin['profile'],
							'title' => $admin['name'],
							'class'=>'user-image img-responsive']
						);
					}else{
						echo $this->Html->image('find_user.png', array('class' => 'user-image img-responsive'));	
					}
				}else{
					echo $this->Html->image('find_user.png', array('class' => 'user-image img-responsive'));		
				}
			?>
         </li>         
         <li>
            <?php
				if($action != 'index' && $action != 'siteConfiguration' && $action != 'changePassword'){$active = 'active-menu';}else{$active = '';}
				echo $this->Html->link(
					'<i class="fa fa-dashboard fa-fw fa-3x"></i> Dashboard',
					 ['controller'=>'Admins','action'=>'dashboard'],
					 ['escape' => false,'class'=>$active]  // important
				);
			 ?>
         </li>    
         <li>
            <?php
				if($action == 'index'){$active = 'active-menu';}else{$active = '';}
				echo $this->Html->link(
					'<i class="fa fa-user fa-fw fa-3x"></i> Profile',					
					['controller'=>'Users','action'=>'index'],
					['escape' => false,'class'=>$active]// important
				);
			 ?>
         </li>
         <li>
            <?php
				if($action == 'siteConfiguration'){$active = 'active-menu';}else{$active = '';}
				echo $this->Html->link(
					'<i class="fa fa-wrench fa-fw fa-3x"></i> Site Configuration',					
					['controller'=>'Admins','action'=>'siteConfiguration'],
					['escape' => false,'class'=>$active]// important
				);
			 ?>
         </li>
		 <li>
            <?php
				if($action == 'changePassword'){$active = 'active-menu';}else{$active = '';}
				echo $this->Html->link(
					'<i class="fa fa-key fa-fw fa-3x"></i> Change Password',					
					['controller'=>'Admins','action'=>'changePassword'],
					['escape' => false,'class'=>$active]// important
				);
			 ?>
         </li>         
      </ul>
   </div>
</nav>