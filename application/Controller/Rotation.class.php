<?php

class Controller_Rotation extends Controller
{
    public function addSchedule()
    {
        $members = Member::find('all', ['order' => 'username']);
        $this->setViewData('members', $members);

        if ($_POST) {
            $schedule = new Schedule();
            $schedule->date = strtotime($_POST['date']);
            $schedule->member_id = $_POST['member_id'];
            $schedule->save();

            $this->redirect($this->url());
        }
    }
}