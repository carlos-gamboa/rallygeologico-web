<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Token $token
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tokens'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tokens form large-9 medium-8 columns content">
    <?= $this->Form->create($token) ?>
    <fieldset>
        <legend><?= __('Add Token') ?></legend>
        <?php
            echo $this->Form->control('value');
            echo $this->Form->control('type');
            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
