<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invitation $invitation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invitation'), ['action' => 'edit', $invitation->InvitationId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invitation'), ['action' => 'delete', $invitation->InvitationId], ['confirm' => __('Are you sure you want to delete # {0}?', $invitation->InvitationId)]) ?> </li>
        <li><?= $this->Html->link(__('List Invitation'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invitation'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invitation view large-9 medium-8 columns content">
    <h3><?= h($invitation->InvitationId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Accepted') ?></th>
            <td><?= h($invitation->Accepted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('InvitationId') ?></th>
            <td><?= $this->Number->format($invitation->InvitationId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UserIdSend') ?></th>
            <td><?= $this->Number->format($invitation->UserIdSend) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UserIdReceive') ?></th>
            <td><?= $this->Number->format($invitation->UserIdReceive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CompetitionId') ?></th>
            <td><?= $this->Number->format($invitation->CompetitionId) ?></td>
        </tr>
    </table>
</div>
