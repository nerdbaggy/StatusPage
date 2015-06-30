<?php
namespace NerdBaggy\StatusPage;

require_once("phpfastcache/phpfastcache.php");
require_once('config.php');
require_once('statusPage.php');
\phpFastCache::setup("storage","files");

header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

$statusPage = new statusPage();

$tableHeaders = $statusPage->getTableHeaders();

$checks = $statusPage->getChecks(( isset($_GET['action']) ? $_GET['action'] : null ));

echo $statusPage->padIt(array('headers' => $tableHeaders, 'checks' => $checks));
