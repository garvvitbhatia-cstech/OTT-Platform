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
?>
<!DOCTYPE html>
<!-- saved from url=(0031)https://www.firstshows.com/home -->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en" prefix="og:http://ogp.me/ns#" itemscope="" itemtype="http://schema.org/WebPage" class="js-focus-visible" data-js-focus-visible="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<base href=".">
<title>Cinemasthan</title>
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="icon" type="image/x-icon" href="#">
<?= $this->Html->css(array('styles-main','styles')) ?>
</head>

<body class="black_theme" style="overflow: visible;" data-new-gr-c-s-check-loaded="14.1018.0" data-gr-ext-installed="" cz-shortcut-listen="true">

<div class="modal_backdrop"></div>
<ott-app _nghost-fce-c55="" ng-version="11.2.14">
  <div _ngcontent-fce-c55="" class="ott-theme page_home page-has-banner mobile-no-sub-menu">
    <div _ngcontent-fce-c55="" id="content_body" class="content_body">
      <?= $this->element('header-main') ?>
      <?= $this->fetch('content') ?>
      <?= $this->element('footer-main') ?>
      </div>
  </div>
</ott-app>

<!-- updated by shivakumar nomula 0200671 -->


</body>

</html>