<?php
if (!defined('FW'))
    die('Forbidden');

$manifest = array();
$manifest['name'] = esc_html__('Articles', 'cannalisting_core');
$manifest['uri'] = 'cannalisting-theme-uri';
$manifest['description'] = esc_html__('This extension will enable providers to create articles from their dashboard.', 'cannalisting_core');
$manifest['version'] = '1.0.2';
$manifest['author'] = 'cannalisting-theme-author';
$manifest['display'] = true;
$manifest['standalone'] = true;
$manifest['author_uri'] = 'cannalisting-theme-uri';
$manifest['github_repo'] = 'https://github.com/Cannalisting/articles';
$manifest['github_update'] = 'Cannalisting/articles';
$manifest['requirements'] = array(
    'wordpress' => array(
        'min_version' => '4.0',
    )
);

$manifest['thumbnail'] = '/static/img/thumbnails/articles.png';
