<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invitation $invitation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $invitation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $invitation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Invitation'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invitation form large-9 medium-8 columns content">
    <?= $this->Form->create($invitation) ?>
    <fieldset>
        <legend><?= __('Edit Invitation') ?></legend>
        <?php
            echo $this->Form->control('accepted');
            echo $this->Form->control('user_id_send');
            echo $this->Form->control('user_id_receive');
            echo $this->Form->control('competition_id', ['options' => $competition]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
