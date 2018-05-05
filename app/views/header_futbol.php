<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $this->session->userdata('c2'); ?></title>
	<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>img/.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	    <meta name="robots" content="noindex">
	    <meta name="googlebot" content="noindex">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/vivo_futbol/css_new/reset.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/vivo_futbol/css_new/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/vivo_futbol/css_new/orientation_utils.css">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,minimal-ui" />
        <meta name="msapplication-tap-highlight" content="no"/>

        <!-- viejo
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/createjs-2015.11.26.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/Three.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/Stats.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/cannon.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/main.js"></script>
		http://gatofutbol.dev.com/gatorade/futbol
		-->

        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js_new/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js_new/createjs.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js_new/howler.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js_new/Three.js"></script>
        
		<script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js_new/CHelpText.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/cannon.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/main.js"></script>


</head>
	

 <body ondragstart="return false;" ondrop="return false;" >
	<div class="container-fluid1">
		<div id="foo"></div>
		
		<div class="row-fluid1" id="wrapper1">
			<div class="alert" id="messages"></div>

    <!-- Inicia Formulario -->
