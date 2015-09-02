
<form method="post" action="<?=$this->url('Rotation', 'editSchedule', $schedule->id)?>">
    <div class="col-lg-4"></div>
    <div class="panel panel-default col-lg-4">
        <div class="panel-heading">Edit Schedule</div>
        <div class="panel-body">

            <dl class="dl-horizontal">
                <dt><label>ID:</label></dt>
                <dd>
                    <div class="form-control-static">
                        <?=$schedule->id?>
                    </div>
                </dd>

                <dt><label>Member:</label></dt>
                <dd>
                    <select name="member_id" class="form-control">
                        <?php foreach ($members as $member): ?>
                        <option value="<?=$member->id?>"<?=$member->id == $schedule->member_id ? ' selected="selected"' : ''?>>
                            <?=$member->username?>
                        </option>
                        <?php endforeach ;?>
                    </select>
                </dd>

                <dt><label>Date:</label></dt>
                <dd>
                    <input type="date" name="date" value="<?=date('Y-m-d', $schedule->date)?>" class="form-control" />
                </dd>

            </dl>

        </div>
        <div class="panel-footer">
            <input type="submit" value="Submit" class="btn btn-default" />
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('input[type=date]').datepicker({
            'dateFormat': 'yy-mm-dd'
        });
    });
</script>