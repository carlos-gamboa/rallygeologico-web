<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsSite $competitionStatisticsSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $competitionStatisticsSite->competition_statistics_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsSite->competition_statistics_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competitionStatisticsSite form large-9 medium-8 columns content">
    <?= $this->Form->create($competitionStatisticsSite) ?>
    <fieldset>
        <legend><?= __('Edit Competition Statistics Site') ?></legend>
        <?php
            echo $this->Form->control('id');
            echo $this->Form->control('visited_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
