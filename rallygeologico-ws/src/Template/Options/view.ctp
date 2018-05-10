<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Option $option
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Option'), ['action' => 'edit', $option->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Option'), ['action' => 'delete', $option->id], ['confirm' => __('Are you sure you want to delete # {0}?', $option->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Options'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Option'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="options view large-9 medium-8 columns content">
    <h3><?= h($option->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Activity') ?></th>
            <td><?= $option->has('activity') ? $this->Html->link($option->activity->id, ['controller' => 'Activity', 'action' => 'view', $option->activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Correct') ?></th>
            <td><?= h($option->is_correct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Option Text') ?></th>
            <td><?= h($option->option_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($option->id) ?></td>
        </tr>
    </table>
</div>
