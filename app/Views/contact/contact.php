<?php $this->layout('layout', ['title' => 'Accueil']); ?>

<?php $this->start('main_content'); ?>
	<h2>Contact.</h2>


   <?= $w_flash_message->message ?? ''; ?>

<form action="<?= $this->url('sendMail') ?>" method="post">
    <input type="text" name="name">
    <input type="text" name="email">
    <textarea name="message"></textarea>
    <button type="submit">Envoyer</button>
</form>
<?php $this->stop(); ?>
