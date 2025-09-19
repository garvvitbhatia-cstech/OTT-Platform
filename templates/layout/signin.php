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

<!-- saved from url=(0038)https://www.firstshows.com/auth/signin -->

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en" prefix="og:http://ogp.me/ns#" itemscope="" itemtype="http://schema.org/WebPage" class="js-focus-visible" data-js-focus-visible="">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!--<base href="/">-->

<base href=".">

<title><?= $this->fetch('title') ?></title>

<meta name="description" content="<?= $this->fetch('meta_description') ?>" />

<meta name="keywords" content="<?= $this->fetch('meta_keywords') ?>" />

<meta name="robots" content="<?= $this->fetch('meta_robot') ?>" />
 <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

<link href="<?= $this->Url->build('/img/favicon.png');?>" type="image/x-icon" rel="icon" />

<?= $this->Html->css(array('sign-in','styles-pricing')) ?>

<?= $this->Html->script(array('jquery-2.1.1.min','csrf')) ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<style>
.form_error_msg{font-size: 12px;
    float: left;
    margin-top: 8px;}
.message.error{border: 1px solid #f00;
    margin-bottom: 25px;
    color: #f00;}
.message.success{border: 1px solid #FFF;
    margin-bottom: 25px;
    color: #FFF;}	
</style>
</head>

<body class="black_theme" style="overflow: visible;" data-new-gr-c-s-check-loaded="14.1018.0" data-gr-ext-installed="" cz-shortcut-listen="true">

<?= $this->fetch('content') ?>

</body>

</html>