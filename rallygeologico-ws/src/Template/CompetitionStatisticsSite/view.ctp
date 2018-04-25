<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsSite $competitionStatisticsSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competition Statistics Site'), ['action' => 'edit', $competitionStatisticsSite->FacebookId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competition Statistics Site'), ['action' => 'delete', $competitionStatisticsSite->FacebookId], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsSite->FacebookId)]) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistics Site'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="competitionStatisticsSite view large-9 medium-8 columns content">
    <h3><?= h($competitionStatisticsSite->FacebookId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('UserId') ?></th>
            <td><?= $this->Number->format($competitionStatisticsSite->UserId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CompetitionId') ?></th>
            <td><?= $this->Number->format($competitionStatisticsSite->CompetitionId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SiteId') ?></th>
            <td><?= $this->Number->format($competitionStatisticsSite->SiteId) ?></td>
        </tr>
    </table>
</div>
