<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Multimedia[]|\Cake\Collection\CollectionInterface $multimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Multimedia'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="multimedia index large-9 medium-8 columns content">
    <h3><?= __('Multimedia') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_url') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($multimedia as $multimedia): ?>
            <tr>
                <td><?= $this->Number->format($multimedia->id) ?></td>
                <td><?= $this->Number->format($multimedia->media_type) ?></td>
                <td><?= h($multimedia->media_url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $multimedia->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $multimedia->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $multimedia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $multimedia->id)]) ?>
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
