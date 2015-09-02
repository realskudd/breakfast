
<legend>Add a schedule</legend>
<form method="post" action="<?=$this->url('Rotation', 'addSchedule')?>">
    <dl class="dl-horizontal">
        <dt>Who:</dt>
        <dd>
            <select name="member_id" class="form-control">
                <?php foreach ($members as $member): ?>
                <option value="<?=$member->id?>"><?=$member->username?></option>
                <?php endforeach; ?>
            </select>
        </dd>

        <dt>When:</dt>
        <dd>
            <input type="date" id="date" name="date" class="form-control" />
        </dd>

        <dt>&nbsp;</dt>
        <dd><input type="submit" value="Submit" class="btn btn-primary" /></dd>
    </dl>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('input[type=date]').datepicker({
            'dateFormat': 'yy-mm-dd'
        });
    });
</script>