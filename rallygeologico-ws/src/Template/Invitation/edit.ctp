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
                ['action' => 'delete', $invitation->InvitationId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $invitation->InvitationId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Invitation'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="invitation form large-9 medium-8 columns content">
    <?= $this->Form->create($invitation) ?>
    <fieldset>
        <legend><?= __('Edit Invitation') ?></legend>
        <?php
            echo $this->Form->control('Accepted');
            echo $this->Form->control('UserIdSend');
            echo $this->Form->control('UserIdReceive');
            echo $this->Form->control('CompetitionId');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
