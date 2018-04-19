<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Term[]|\Cake\Collection\CollectionInterface $term
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Term'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="term index large-9 medium-8 columns content">
    <h3><?= __('Term') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('TermID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ImageUrl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('VideoUrl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($term as $term): ?>
            <tr>
                <td><?= $this->Number->format($term->TermID) ?></td>
                <td><?= h($term->ImageUrl) ?></td>
                <td><?= h($term->VideoUrl) ?></td>
                <td><?= h($term->Name) ?></td>
                <td><?= h($term->Description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $term->TermID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $term->TermID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $term->TermID], ['confirm' => __('Are you sure you want to delete # {0}?', $term->TermID)]) ?>
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
