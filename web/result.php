<?php

ini_set('display_errors', 0);

use ExerciseV18\{CompanyStatistics, Validator};

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

$validator = new Validator([
    'company-symbol' => ['required' => true, 'pattern' => '/[A-Z\^]{1,6}/'],
    'start-date' => ['required' => true, 'pattern' => '/[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}/'],
    'end-date' => ['required' => true, 'pattern' => '/[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}/', 'after' => 'start-date'],
    'email' => ['required' => true, 'type' => 'email']
]);

$error = '';
$data = $_POST;

try {
    $validator->validate($data);
} catch (\Exception $e) {
    $error = $e->getMessage();
    require_once __DIR__ . '/../tpl/index.php';
    exit();
}

$companyStatistics = new CompanyStatistics();
$result = $companyStatistics->get($data['company-symbol'], $data['start-date'], $data['end-date']);

if ($result['httpCode'] != 200) {
    $error = $result['data'][1][1];
}

if ($result['httpCode'] == 200 && count($result['data']) === 1) {
    $error = 'This date range dosn\'t have any data!';
}

if (!empty($error)) {
    require_once __DIR__ . '/../tpl/index.php';
    exit();
}

if (SEND_EMAIL) {
    // Create the Transport
    $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message($data['company-symbol']))
      ->setFrom(EMAIL_FROM)
      ->setTo([$data['email']])
      ->setBody('From ' . $data['start-date'] . ' to ' . $data['end-date']);

    // Send the message
    $numSent = $mailer->send($message);
}

require_once __DIR__ . '/../tpl/result.php';