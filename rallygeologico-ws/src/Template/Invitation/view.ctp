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
        <li><?= $this->Html->link(__('List User Send'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Send'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Receive'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Receive'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invitation view large-9 medium-8 columns content">
    <h3><?= h($invitation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User Send') ?></th>
            <td><?= $invitation->has('user_send') ? $this->Html->link($invitation->user_send->id, ['controller' => 'Users', 'action' => 'view', $invitation->user_send->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Receive') ?></th>
            <td><?= $invitation->has('user_receive') ? $this->Html->link($invitation->user_receive->id, ['controller' => 'Users', 'action' => 'view', $invitation->user_receive->id]) : '' ?></td>
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
            <th scope="row"><?= __('Accepted') ?></th>
            <td><?= $this->Number->format($invitation->accepted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rejected') ?></th>
            <td><?= $this->Number->format($invitation->rejected) ?></td>
        </tr>
    </table>
</div>
