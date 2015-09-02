<?php

class Controller_Index extends Controller
{
    public function index()
    {
        $this->handle('Index/overview');
        return false;
    }

    public function overview()
    {
        $members = Member::find('all', ['order' => 'username']);
        $this->setViewData('members', $members);

        $schedules = Schedule::find('all', ['conditions' => ['date >= UNIX_TIMESTAMP()'], 'order' => 'date']);
        $this->setViewData('schedules', $schedules);
    }
}