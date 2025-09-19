<?php
   $cakeDescription = 'CakePHP: the rapid development php framework';
   $paramController = $this->request->getParam('controller');
?>

<!DOCTYPE html>
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
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<?= $this->Html->css(array('pricing','styles-pricing','style','bootstrap.min')) ?>
<?= $this->Html->script(array('jquery-2.1.1.min','bootstrap.min')) ?>
</head>
<body class="black_theme" style="overflow: visible;" data-new-gr-c-s-check-loaded="14.1018.0" data-gr-ext-installed="" cz-shortcut-listen="true">
<div class="modal_backdrop"></div>
<ott-app _nghost-ytn-c55="" ng-version="11.2.14">
  <div _ngcontent-ytn-c55="" class="ott-theme page_buy/packages-list page-scroll mobile-no-sub-menu">
    <div _ngcontent-ytn-c55="" id="content_body" class="content_body">
      <?= $this->element('header-home') ?>
      <?= $this->fetch('content') ?>
       <?= $this->element('footer-content') ?>
      </div>
  </div>
</ott-app>
</body>
</html>