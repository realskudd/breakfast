
<form method="post" action="<?=$this->url('Rotation', 'swapSchedule', $schedule->id)?>">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Swap This Schedule
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Member:</dt>
                        <dd><?=$schedule->member->username?></dd>

                        <dt>Date:</dt>
                        <dd><?=$this->formatDate($schedule->date, 'm/d')?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    With This Schedule
                </div>
                <div class="panel-body">
                    <select name="swap-schedule" class="form-control">
                        <?php foreach ($schedules as $otherSchedule): ?>
                        <?php if ($otherSchedule->id == $schedule->id) continue; ?>
                        <option value="<?=$otherSchedule->id?>">
                            <?=$otherSchedule->member->username?> - <?=$this->formatDate($otherSchedule->date, 'm/d')?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body text-right">
                    <input type="submit" value="Submit" class="btn btn-default" />
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        var panels = $('div.panel-body');

        $(panels[1]).css('height', $(panels[0]).css('height'));
    });
</script>