<?php


$response = $mailxpert->sendRequest('GET', 'cp/customers');

/** @var \Mailxpert\Model\CP\Customer[]|\Mailxpert\Model\CP\CustomerCollection $customers */
$customers = $response->getMailxpertNode();

?>
<ul>
    <?php foreach($customers as $customer): ?>
    <li><?php echo $customer->getCustomerName() ?></li>
    <?php endforeach; ?>
</ul>
<p><a href="index.php">Menu</a></p>