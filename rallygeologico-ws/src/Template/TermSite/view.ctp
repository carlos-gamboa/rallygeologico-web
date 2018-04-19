<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TermSite $termSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Term Site'), ['action' => 'edit', $termSite->TermId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Term Site'), ['action' => 'delete', $termSite->TermId], ['confirm' => __('Are you sure you want to delete # {0}?', $termSite->TermId)]) ?> </li>
        <li><?= $this->Html->link(__('List Term Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term Site'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="termSite view large-9 medium-8 columns content">
    <h3><?= h($termSite->TermId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('TermId') ?></th>
            <td><?= $this->Number->format($termSite->TermId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SiteId') ?></th>
            <td><?= $this->Number->format($termSite->SiteId) ?></td>
        </tr>
    </table>
</div>
