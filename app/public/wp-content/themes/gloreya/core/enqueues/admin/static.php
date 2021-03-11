<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue static files: javascript and css for backend
 */

wp_enqueue_style('iconfont', GLOREYA_CSS . '/iconfont.css', null, GLOREYA_VERSION);
wp_enqueue_style('gloreya-admin', GLOREYA_CSS . '/gloreya-admin.css', null, GLOREYA_VERSION);
wp_enqueue_script('gloreya-admin', GLOREYA_JS . '/gloreya-admin.js', array('jquery'), GLOREYA_VERSION, true);