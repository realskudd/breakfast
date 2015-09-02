
<table class="table table-striped table-condensed">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>Person</th>
        <th>Date</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="3" class="text-right">
            <a href="<?=$this->url('Rotation', 'addSchedule')?>" class="btn btn-sm btn-default">
                <b class="glyphicon glyphicon-plus"></b>
                Add a schedule
            </a>
        </td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($schedules as $schedule): ?>
    <tr>
        <td>
            <a href="<?=$this->url('Rotation', 'editSchedule', $schedule->id)?>" title="Edit Schedule">
                <b class="glyphicon glyphicon-pencil"></b>
            </a>
            <a href="<?=$this->url('Rotation', 'swapSchedule', $schedule->id)?>" title="Swap Schedule">
                <b class="glyphicon glyphicon-random"></b>
            </a>
        </td>
        <td>
            <?=$schedule->member->username?>
        </td>
        <td>
            <?=$this->formatDate($schedule->date, 'm/d')?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>