<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionsStatistic $competitionsStatistic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $competitionsStatistic->FacebookId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $competitionsStatistic->FacebookId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Competitions Statistics'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="competitionsStatistics form large-9 medium-8 columns content">
    <?= $this->Form->create($competitionsStatistic) ?>
    <fieldset>
        <legend><?= __('Edit Competitions Statistic') ?></legend>
        <?php
            echo $this->Form->control('UserId');
            echo $this->Form->control('StartingDate', ['empty' => true]);
            echo $this->Form->control('FinishingDate', ['empty' => true]);
            echo $this->Form->control('Points');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
