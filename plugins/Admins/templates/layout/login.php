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

   ?>

<!DOCTYPE html>

<html>

   <head>

      <?= $this->Html->charset() ?>

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Cinemasthan Login</title>

      <?php //$this->Html->meta('icon') ?>

      <link href="<?= $this->Url->build('/img/rcube-title.jpeg');?>" type="image/x-icon" rel="icon" />

      <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

      <?= $this->Html->css('bootstrap.css') ?>

      <?= $this->Html->css('font-awesome.css') ?>

      <?= $this->Html->css('/css/custom.css') ?>

      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

      <?= $this->Html->script('jquery-1.10.2.js') ?>

      <?= $this->Html->script('bootstrap.min.js') ?>

      <?= $this->Html->script('jquery.metisMenu.js') ?>

      

      <?= $this->fetch('meta') ?>

      <?= $this->fetch('css') ?>

      <?= $this->fetch('script') ?>

   </head>

   <body style="background:#333">

      <?= $this->Flash->render() ?>

      <?= $this->fetch('content') ?>

   </body>

</html>