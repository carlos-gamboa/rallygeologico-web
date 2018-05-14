<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Canton $canton
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Canton'), ['action' => 'edit', $canton->name]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Canton'), ['action' => 'delete', $canton->name], ['confirm' => __('Are you sure you want to delete # {0}?', $canton->name)]) ?> </li>
        <li><?= $this->Html->link(__('List Canton'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Canton'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Province'), ['controller' => 'Province', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Province', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List District'), ['controller' => 'District', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'District', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="canton view large-9 medium-8 columns content">
    <h3><?= h($canton->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($canton->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Province') ?></th>
            <td><?= $canton->has('province') ? $this->Html->link($canton->province->name, ['controller' => 'Province', 'action' => 'view', $canton->province->name]) : '' ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related District') ?></h4>
        <?php if (!empty($canton->district)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Canton Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($canton->district as $district): ?>
            <tr>
                <td><?= h($district->name) ?></td>
                <td><?= h($district->canton_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'District', 'action' => 'view', $district->name]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'District', 'action' => 'edit', $district->name]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'District', 'action' => 'delete', $district->name], ['confirm' => __('Are you sure you want to delete # {0}?', $district->name)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
