<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invitation[]|\Cake\Collection\CollectionInterface $invitation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Invitation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invitation index large-9 medium-8 columns content">
    <h3><?= __('Invitation') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accepted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id_send') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id_receive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('competition_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invitation as $invitation): ?>
            <tr>
                <td><?= $this->Number->format($invitation->id) ?></td>
                <td><?= h($invitation->accepted) ?></td>
                <td><?= $this->Number->format($invitation->user_id_send) ?></td>
                <td><?= $this->Number->format($invitation->user_id_receive) ?></td>
                <td><?= $invitation->has('competition') ? $this->Html->link($invitation->competition->id, ['controller' => 'Competition', 'action' => 'view', $invitation->competition->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invitation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invitation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invitation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invitation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
