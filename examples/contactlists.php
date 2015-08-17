<?php


$response = $mailxpert->sendRequest('GET', 'contact_lists');

$data = json_decode($response->getBody(), true);

?>
<ul>
    <?php foreach($data['data'] as $contactlist): ?>
    <li><?php echo $contactlist['name']; ?><?php if ($contactlist['default']): ?> *<?php endif; ?></li>
    <?php endforeach; ?>
</ul>
<p><a href="index.php">Menu</a></p>