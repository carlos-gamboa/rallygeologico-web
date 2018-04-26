<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RallySite[]|\Cake\Collection\CollectionInterface $rallySite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rally Site'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rallySite index large-9 medium-8 columns content">
    <h3><?= __('Rally Site') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('rally_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('site_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rallySite as $rallySite): ?>
            <tr>
                <td><?= $rallySite->has('rally') ? $this->Html->link($rallySite->rally->name, ['controller' => 'Rally', 'action' => 'view', $rallySite->rally->id]) : '' ?></td>
                <td><?= $rallySite->has('site') ? $this->Html->link($rallySite->site->name, ['controller' => 'Site', 'action' => 'view', $rallySite->site->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rallySite->rally_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rallySite->rally_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rallySite->rally_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rallySite->rally_id)]) ?>
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
