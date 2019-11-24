<?php
require_once 'curlClass.php';

use chlassGrabber\doit;

$url = 'https://apkpure.com/id/search';
$search = $_REQUEST['cari'];
$query = array(
    'q' => $search,
);

doit::prepare($url, $query);
doit::exec_get();

$put = doit::get_response();
// preg_match_all('/<dl\s[^>]*class="search-dl">(.*)<\/dl>/siU', $put, $matches);
preg_match_all('/<dt><a title=".*?" target="_blank" href="(.*?)"><img title=/', $put, $matches);
// var_dump($matches);

$url = 'https://apkpure.com' . $matches[1][0] . '/download?from=details';

doit::prepare($url, $query);
doit::exec_get();

$put = doit::get_response();
preg_match_all('/<iframe id="iframe_download" src="(.*?)"><\/iframe>/', $put, $matches);
// var_dump($matches);

$url = '' . $matches[1][0] . '';
header('Referrer-Policy: no-referrer');
header('Location: ' . $url . '', true, 307);
