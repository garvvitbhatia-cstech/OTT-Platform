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

<!-- saved from url=(0044)https://www.firstshows.com/buy/packages-list -->

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en" prefix="og:http://ogp.me/ns#" itemscope="" itemtype="http://schema.org/WebPage" class="js-focus-visible" data-js-focus-visible="">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<base href=".">

<title><?= $this->fetch('title') ?></title>

<meta name="description" content="<?= $this->fetch('meta_description') ?>" />

<meta name="keywords" content="<?= $this->fetch('meta_keywords') ?>" />

<meta name="robots" content="<?= $this->fetch('meta_robot') ?>" />
 <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
<link href="<?= $this->Url->build('/img/favicon.png');?>" type="image/x-icon" rel="icon" />

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->Url->build('/img/apple-icon-180x180.png'); ?>">

<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->Url->build('/img/favicon-32x32.png'); ?>">

<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $this->Url->build('/img/favicon-96x96.png'); ?>">

<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->Url->build('/img/favicon-16x16.png'); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

<?= $this->Html->css(array('styles-pricing','style','bootstrap.min','owl.carousel.min')) ?>

<?= $this->Html->script(array('jquery-3.4.1.min','csrf','bootstrap.min','owl.carousel','custom')) ?>

</head>



<body class="black_theme" style="overflow: visible;" data-new-gr-c-s-check-loaded="14.1018.0" data-gr-ext-installed="" cz-shortcut-listen="true">



<div class="modal_backdrop"></div>

<ott-app _nghost-ytn-c55="" ng-version="11.2.14">

  <div _ngcontent-ytn-c55="" class="ott-theme page_buy/packages-list page-scroll mobile-no-sub-menu">

    <div _ngcontent-ytn-c55="" id="content_body" class="content_body">

      <?= $this->element('header-home') ?>

      <?= $this->fetch('content') ?>

       <?= $this->element('footer-home') ?>

      

      </div>

  </div>

</ott-app>

</body>



</html>