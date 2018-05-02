<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RallySite $rallySite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rally Site'), ['action' => 'edit', $rallySite->rally_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rally Site'), ['action' => 'delete', $rallySite->rally_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rallySite->rally_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rally Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally Site'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rallySite view large-9 medium-8 columns content">
    <h3><?= h($rallySite->rally_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Rally') ?></th>
            <td><?= $rallySite->has('rally') ? $this->Html->link($rallySite->rally->name, ['controller' => 'Rally', 'action' => 'view', $rallySite->rally->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Site') ?></th>
            <td><?= $rallySite->has('site') ? $this->Html->link($rallySite->site->name, ['controller' => 'Site', 'action' => 'view', $rallySite->site->id]) : '' ?></td>
        </tr>
    </table>
</div>
