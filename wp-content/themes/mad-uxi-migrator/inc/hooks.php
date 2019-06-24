<?php

/**
 * Contained In:
 * 404.php, archive.php, category.php, front-page.php, index.php, page.php, search.php, single.php, tag.php and page-templates folder
*/

function mad_content_before() { do_action('mad_content_before'); }
function mad_content_after() { do_action('mad_content_after'); }
function mad_main_before() { do_action('mad_main_before'); }
function mad_main_after() { do_action('mad_main_after'); }
function mad_main_inside_before() { do_action('mad_main_inside_before'); }
function mad_main_inside_after() { do_action('mad_main_inside_after'); }

/**
 * Contained In templates/ :
 * loop.php, loop-single.php, loop-search.php 
*/

function mad_post_before() { do_action('mad_post_before'); }
function mad_post_after() { do_action('mad_post_after'); }
function mad_post_inside_before() { do_action('mad_post_inside_before'); }
function mad_post_inside_after() { do_action('mad_post_inside_after'); }

/**
 * Contained In templates/ :
 * loop-single.php, loop-search.php 
*/

function mad_posts_pagination() { do_action('mad_posts_pagination'); }

?>