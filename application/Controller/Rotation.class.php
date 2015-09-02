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

    public function listSchedules()
    {
        $schedules = $this->getSchedules();
        $this->setViewData('schedules', $schedules);
    }

    public function editSchedules()
    {
        $this->listSchedules();
    }

    public function swapSchedule($scheduleId)
    {
        $schedule = $this->getSchedule($scheduleId);

        if ($_POST) {
            $swapSchedule = $this->getSchedule($_POST['swap-schedule']);

            $swapDate = $swapSchedule->date;
            $swapSchedule->date = $schedule->date;
            $swapSchedule->save();

            $schedule->date = $swapDate;
            $schedule->save();

            $this->redirect($this->url('Rotation', 'editSchedules'));
        }

        $this->setViewData('schedule', $schedule);
        $this->setViewData('schedules', $this->getSchedules());
    }

    public function editSchedule($scheduleId)
    {
        $schedule = $this->getSchedule($scheduleId);

        if ($_POST) {
            $schedule->member_id = $_POST['member_id'];
            $schedule->date = strtotime($_POST['date']);
            $schedule->save();

            $this->redirect($this->url('Rotation', 'editSchedules'));
        }

        $this->setViewData('members', $this->getMembers());
        $this->setViewData('schedule', $schedule);
    }

    /**
     * @return mixed
     * @throws \ActiveRecord\RecordNotFound
     */
    public function getSchedules()
    {
        $options = [
            'conditions' => [
                'date >= ?',
                strtotime(date('Y-m-d 00:00:00')),
            ],
            'order'      => 'date ASC'
        ];

        $schedules = Schedule::find('all', $options);
        return $schedules;
    }

    public function getSchedule($scheduleId)
    {
        $schedule = Schedule::find_by_id($scheduleId);
        if (!$schedule instanceof Schedule) {
            throw new Exception('Invalid schedule: ' . $scheduleId);
        }

        return $schedule;
    }

    public function getMembers()
    {
        $options = [
            'order' => 'username'
        ];

        $members = Member::find('all', $options);
        return $members;
    }
}