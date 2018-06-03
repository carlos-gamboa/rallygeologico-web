<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermMultimedia $termMultimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Term Multimedia'), ['action' => 'edit', $termMultimedia->multimedia_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Term Multimedia'), ['action' => 'delete', $termMultimedia->multimedia_id], ['confirm' => __('Are you sure you want to delete # {0}?', $termMultimedia->multimedia_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Term Multimedia'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term Multimedia'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Multimedia'), ['controller' => 'Multimedia', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Multimedia'), ['controller' => 'Multimedia', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="termMultimedia view large-9 medium-8 columns content">
    <h3><?= h($termMultimedia->multimedia_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Term') ?></th>
            <td><?= $termMultimedia->has('term') ? $this->Html->link($termMultimedia->term->name, ['controller' => 'Term', 'action' => 'view', $termMultimedia->term->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Multimedia') ?></th>
            <td><?= $termMultimedia->has('multimedia') ? $this->Html->link($termMultimedia->multimedia->id, ['controller' => 'Multimedia', 'action' => 'view', $termMultimedia->multimedia->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($termMultimedia->id) ?></td>
        </tr>
    </table>
</div>
