<?php
require_once __DIR__ . '/../../lib/SecurityService.php';
$antiCSRF = new SecurityService\securityService();
$antiCSRF->insertHiddenToken();