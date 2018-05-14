<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermSite $termSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Term Site'), ['action' => 'edit', $termSite->term_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Term Site'), ['action' => 'delete', $termSite->term_id], ['confirm' => __('Are you sure you want to delete # {0}?', $termSite->term_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Term Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term Site'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="termSite view large-9 medium-8 columns content">
    <h3><?= h($termSite->term_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Term') ?></th>
            <td><?= $termSite->has('term') ? $this->Html->link($termSite->term->name, ['controller' => 'Term', 'action' => 'view', $termSite->term->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Term Id') ?></th>
            <td><?= $this->Number->format($termSite->term_id) ?></td>
        </tr>
    </table>
</div>
