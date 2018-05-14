<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermSite[]|\Cake\Collection\CollectionInterface $termSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Term Site'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="termSite index large-9 medium-8 columns content">
    <h3><?= __('Term Site') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('term_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('site_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($termSite as $termSite): ?>
            <tr>
                <td><?= $this->Number->format($termSite->term_id) ?></td>
                <td><?= $termSite->has('term') ? $this->Html->link($termSite->term->name, ['controller' => 'Term', 'action' => 'view', $termSite->term->id]) : '' ?></td>
                <td><?= $termSite->has('site') ? $this->Html->link($termSite->site->name, ['controller' => 'Site', 'action' => 'view', $termSite->site->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $termSite->term_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $termSite->term_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $termSite->term_id], ['confirm' => __('Are you sure you want to delete # {0}?', $termSite->term_id)]) ?>
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
