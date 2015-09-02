
<div class="jumbotron">
    <h1>BREAKFAST!</h1>
    <p>
        ...
    </p>
</div>

<div class="row">
    <div class="panel panel-default col-lg-6">
        <div class="panel-heading">
            Who is participating?
        </div>
        <div class="panel-body">
            <ul>
                <?php foreach ($members as $member): ?>
                <li><?=$member->username?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="panel panel-default col-lg-6">
        <div class="panel-heading">
            What is the schedule?
        </div>
        <div class="panel-body">
            <ul>
                <?php foreach ($schedules as $schedule): ?>
                <li>
                    <strong><?=$this->formatDate($schedule->date, 'm/d')?>:</strong>
                    <?=$schedule->member->username?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="panel-footer text-right">
            <a href="<?=$this->url('Rotation', 'addSchedule')?>" class="btn btn-sm btn-default">
                <b class="glyphicon glyphicon-plus"></b>
                Add a schedule
            </a>
            <a href="<?=$this->url('Rotation', 'editSchedules')?>" class="btn btn-sm btn-default">
                <b class="glyphicon glyphicon-pencil"></b>
                Edit Schedules
            </a>
        </div>
    </div>

</div>