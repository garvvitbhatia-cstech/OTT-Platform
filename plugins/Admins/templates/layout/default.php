<?php
   /**
    * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
    * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
    *
    * Licensed under The MIT License
    * For full copyright and license information, please see the LICENSE.txt
    * Redistributions of files must retain the above copyright notice.
    *
    * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
    * @link          https://cakephp.org CakePHP(tm) Project
    * @since         0.10.0
    * @license       https://opensource.org/licenses/mit-license.php MIT License
    * @var \App\View\AppView $this
    */
   
   $cakeDescription = 'CakePHP: the rapid development php framework';
   $paramController = $this->request->getParam('controller');
   $setting = $this->Admin->getSettingDetails();
   if(file_exists(WWW_ROOT.'img/logo/'.$setting['logo'])){
    $siteLogo = $setting['logo'];
    }else{
      $siteLogo = 'favicon.ico';
    }
?>
<!DOCTYPE html>
<html>
   <head>
      <?= $this->Html->charset() ?>
      <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= SITE_TITLE.': '.$title_for_layout ?></title>
        <meta name="description" content="<?= $this->fetch('meta_description') ?>" />
        <meta name="keywords" content="<?= $this->fetch('meta_keywords') ?>" />
        <meta name="robots" content="<?= $this->fetch('meta_robot') ?>" />
        <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
        <?php //$this->Html->meta('icon') ?>
		<link href="<?php echo $this->Url->build('/img/favicon-32x32.png'); ?>" type="image/x-icon" rel="icon" />
        
      <?= $this->Html->css('bootstrap.css') ?>
      <?= $this->Html->css('font-awesome.css') ?>
      <?= $this->Html->css('custom.css') ?>
      <?= $this->Html->css('dropzone.css') ?>
      <?= $this->Html->css('dataTables/dataTables.bootstrap.css') ?>
      <?php /* $this->Html->css('morris/morris-0.4.3.min.css') */?>
      <?= $this->Html->css('sweet-alert.css') ?>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      
      <?= $this->Html->script('jquery-3.5.1.js') ?>
      <?= $this->Html->script('bootstrap.min.js') ?>
      <?= $this->Html->script('jquery.validate.min.js') ?>            
      <?= $this->Html->script('common.js') ?>
      <?= $this->Html->script('jquery.metisMenu.js') ?>
      <?= $this->Html->script('dataTables/jquery.dataTables.js') ?>
      <?= $this->Html->script('dataTables/dataTables.bootstrap.js') ?>
      <?= $this->Html->script('sweet-alert.min.js') ?>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      
      <?= $this->fetch('meta') ?>
      <?= $this->fetch('css') ?>
      <?= $this->fetch('script') ?>
   </head>
   <body>
    <div id="wrapper">
      <?= $this->Flash->render() ?>
      <?= $this->element('left') ?>
      <?= $this->element('top') ?>
      <?= $this->fetch('content') ?>
    </div>
   </body>
</html>

<script type="text/javascript">
	var SITEURL = '<?php echo SITEURL; ?>';
</script>