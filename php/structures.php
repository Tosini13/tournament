<?php

class Tournament {

    private $name;
    private $host_name;
    private $host_logo;
    private $host_url;
    private $sponsor_name;
    private $sponsor_logo;
    private $sponsor_url;
    private $participants_qtt;
    private $group_qtt;
    private $mode; //0-group; 1-play-offs; 2-both
    public $groups = array();
    public $play_offs;

    //SET

    public function set_name($arg) {
        $this->name = $arg;
    }

    public function set_host_name($arg) {
        $this->host_name = $arg;
    }

    public function set_host_logo($arg) {
        $this->host_logo = $arg;
    }

    public function set_host_url($arg) {
        $this->host_url = $arg;
    }

    public function set_sponsor_name($arg) {
        $this->sponsor_name = $arg;
    }

    public function set_sponsor_logo($arg) {
        $this->sponsor_logo = $arg;
    }

    public function set_sponsor_url($arg) {
        $this->sponsor_url = $arg;
    }

    public function set_participants_qtt($arg) {
        $this->participants_qtt = $arg;
    }

    public function set_group_qtt($arg) {
        $this->group_qtt = $arg;
    }

    public function set_mode($arg) {
        $this->mode = $arg;
    }

    //GET

    public function get_name() {
        return $this->name;
    }

    public function get_host_name() {
        return $this->host_name;
    }

    public function get_host_logo() {
        return $this->host_logo;
    }

    public function get_host_url() {
        return $this->host_url;
    }

    public function get_sponsor_name() {
        return $this->sponsor_name;
    }

    public function get_sponsor_logo() {
        return $this->sponsor_logo;
    }

    public function get_sponsor_url() {
        return $this->sponsor_url;
    }

    public function get_participants_qtt() {
        return $this->participants_qtt;
    }

    public function get_group_qtt() {
        return $this->group_qtt;
    }

    public function get_mode() {
        return $this->mode;
    }

    //FUNCTIONS

    public function declare_groups() {
        //when odd number of participants
        if ($this->get_group_qtt() != 1) {
            $rest_teams = $this->get_participants_qtt() % $this->get_group_qtt();
        } else {
            $rest_teams = 1;
        }

        for ($i = 0; $i < $this->get_group_qtt(); $i++) {
            //check if in group shouldn't be the same amount of teams
            if ($rest_teams != 0) {
                $add = 1;
                $rest_teams--;
            } else {
                $add = 0;
            }
            //how many team should to be in particular group
            $this->groups[$i] = new Group(chr(65 + $i), $this->teams_qtt_in_group() + $add);
            //create teams in group
            for ($j = 0; $j < $this->groups[$i]->teams_qtt; $j++) {
                $this->groups[$i]->teams[$j] = new Team('Zespół nr ' . ($j + 1));
            }
        }
    }

    public function teams_qtt_in_group() {
        return intval($this->participants_qtt / $this->group_qtt);
    }

    //CONSTRUCTORS

    public function __construct($name, $participants_qtt) {
        $this->name = $name;
        $this->participants_qtt = $participants_qtt;
        /*
          //$this->mode = $mode;
          switch ($mode) {
          case 1:
          $this->play_offs = null;
          $this->groups = array();
          $this->declare_groups();
          break;
          case 2:
          $this->group = null;
          break;
          case 3:
          $this->groups = array();
          $this->declare_groups();
          break;
          }
         * */
    }

}

class Group {

    public $name;
    public $teams_qtt;
    public $teams = array();
    public $result;

    public function __construct($name, $teams_qtt) {
        $this->name = $name;
        $this->teams_qtt = $teams_qtt;
    }

}

class Play_offs {

    public $rounds;
    public $matches = array();

}

class Match {

    public $team1;
    public $team2;
    public $result;

}

class Group_table {

    public $team;
    public $points;
    public $wins;
    public $loses;
    public $draws;
    public $scores;
    public $lost_goals;

}

class Team {

    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

}
