<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invitation $invitation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invitation'), ['action' => 'edit', $invitation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invitation'), ['action' => 'delete', $invitation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invitation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invitation'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invitation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invitation view large-9 medium-8 columns content">
    <h3><?= h($invitation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Accepted') ?></th>
            <td><?= h($invitation->accepted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Competition') ?></th>
            <td><?= $invitation->has('competition') ? $this->Html->link($invitation->competition->id, ['controller' => 'Competition', 'action' => 'view', $invitation->competition->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invitation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id Send') ?></th>
            <td><?= $this->Number->format($invitation->user_id_send) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id Receive') ?></th>
            <td><?= $this->Number->format($invitation->user_id_receive) ?></td>
        </tr>
    </table>
</div>
