<?php

// --------------------------------------------------------------------
// >>>>>>>>>>>>>>>>>>>>>>>>>>>TOURNAMENT<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// --------------------------------------------------------------------

class Tournament {

    private $id;
    private $name;
    private $host;
    private $sponsor;
    private $participants_qtt;
    private $group_qtt;
    private $play_offs_qtt; //i.e. quaterfinal
    private $start_date;
    private $end_date;
    public $no_last_place;
    private $mode; //0-group; 1-play-offs; 2-both
    public $groups = array();
    public $play_offs;
    public $teams = array();

    //SET

    public function set_name($arg) {
        $this->name = $arg;
    }

    public function set_participants_qtt($arg) {
        $this->participants_qtt = $arg;
    }

    public function set_group_qtt($arg) {
        if ($arg > $this->participants_qtt) {
            $this->group_qtt = $this->participants_qtt;
        } else {
            $this->group_qtt = $arg;
        }
    }

//WHY I divide it one more time!
    public function set_play_offs_qtt($arg) {
        while ($arg * 2 > $this->participants_qtt) {  //when there's more play offs than participants
            $arg /= 2;
        }
        if ($arg * 2 < $this->group_qtt) {
            $arg = $this->group_qtt / 2;
        }
        //$this->play_offs_qtt = $arg / 2;
        $this->play_offs_qtt = $arg;
    }

    public function set_no_last_place($arg) {
        $this->no_last_place = $arg;
    }

    public function set_mode($arg) {
        $this->mode = $arg;
    }

    public function set_host($name, $logo, $url) {
        $this->host->set_name($name);
        $this->host->set_logo($logo);
        $this->host->set_url($url);
    }

    public function set_sponsor($name, $logo, $url) {
        $this->sponsor->set_name($name);
        $this->sponsor->set_logo($logo);
        $this->sponsor->set_url($url);
    }

    public function set_id($arg) {
        $this->id = $arg;
    }

    public function set_start_date($arg) {
        $this->start_date = $this->datetime_validation($arg);
    }

    public function set_end_date($arg) {
        $this->end_date = $this->datetime_validation($arg);
    }

    //GET

    public function get_name() {
        return $this->name;
    }

    public function get_start_date() {
        return $this->start_date;
    }

    public function get_end_date() {
        return $this->end_date;
    }

    public function get_participants_qtt() {
        return $this->participants_qtt;
    }

    public function get_group_qtt() {
        return $this->group_qtt;
    }

    public function get_play_offs_qtt() {
        return $this->play_offs_qtt;
    }

    public function get_no_last_place() {
        return $this->no_last_place;
    }

    public function get_mode() {
        return $this->mode;
    }

    public function get_host() {
        return $this->host;
    }

    public function get_sponsor() {
        return $this->sponsor;
    }

    public function get_id() {
        return $this->id;
    }

    //FUNCTIONS

    function datetime_validation($arg) {
        if ($arg == '') {
            return date('Ymd');
        } else {
            $arg = str_replace('-', '', $arg);
            $arg = str_replace(':', '', $arg);
            $arg = str_replace('T', '', $arg);
            for ($i = strlen($arg); $i < 14; $i++) {
                $arg .= "0"; //seconds
            }
        }
        return $arg;
    }

    public function declare_teams() {
        for ($i = 0; $i < $this->participants_qtt; $i++) {
            $this->teams[$i] = new Team();
            $this->teams[$i]->set_name("Zespół nr " . ($i + 1));
        }
    }

    public function declare_groups($group_qtt, $play_offs_qtt) {
        $team_qtt = 0;
        $this->set_group_qtt($group_qtt);
        $this->set_play_offs_qtt($play_offs_qtt);
        //when odd number of participants
        if ($this->get_group_qtt() != 1) {
            $rest_teams = $this->get_participants_qtt() % $this->get_group_qtt();
        } else {
            $rest_teams = 0;
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
            $this->groups[$i] = new Group('Grupa ' . chr(65 + $i), $this->teams_qtt_in_group() + $add);
            $this->groups[$i]->promoted_teams_qtt($this->group_qtt, $this->get_play_offs_qtt());
            //create teams in group
            for ($j = 0; $j < $this->groups[$i]->teams_qtt; $j++) {
                $this->groups[$i]->teams[$j] = $this->teams[$team_qtt++];
                //$this->groups[$i]->teams[$j]->set_name('Zespół nr ' . ($j + 1) . ' G: ' . $this->groups[$i]->name);
            }
            $this->groups[$i]->create_matches();
        }
    }

    public function promoted_all_teams() {
        $promoted_all_teams = array();
        $i = 0;
        foreach ($this->groups as $index => $group) {
            $j = 0;
            foreach ($group->promoted_teams() as $index => $team) {
                if ($i == 0) {
                    $promoted_all_teams[$j] = array();
                }
                $promoted_all_teams[$j++][$i] = $team;
            }
            $i++;
        }
        for ($i = count($promoted_all_teams) / 2; $i < (count($promoted_all_teams)); $i++) { //second half of teams
            $temp = array();
            for ($j = 0; $j < count($promoted_all_teams[$i]); $j++) {
                $temp[$j] = $promoted_all_teams[$i][count($promoted_all_teams[$i]) - $j - 1];
            }
            $promoted_all_teams[$i] = $temp;
        }
        return $promoted_all_teams;
    }

    public function play_offs_preparation() {
        //order group of promoted teams for first round of play-offs
        //reverse
        $all = array();
        if ($this->mode == 1) {
            //DECLARING TEAMS!!!!
            $all[0] = array();
            $all[0] = $this->teams;
        } else {
            $all = $this->promoted_all_teams();
        }
        $places_qtt = count($all);
        $promoted_qtt = count($all[0]); //group_qtt?!?
        $new_order = array();
        $new_order_qtt = -1;
        for ($i = 0; $i < $places_qtt; $i++) {
            if ($i % 2 == 0) {
                $place = $i;
                $new_order_qtt++;
            } else {
                $place = $places_qtt - $i;
            }
            for ($j = 0; $j < $promoted_qtt; $j++) {
                if ($i % 2 == 0) {
                    $new_order[$new_order_qtt * $promoted_qtt + $j] = new Match();
                    $new_order[$new_order_qtt * $promoted_qtt + $j]->set_team1($all[$place][$j]);
                } else {
                    $new_order[$new_order_qtt * $promoted_qtt + $j]->set_team2($all[$place][$j]);
                }
            }
        }
        return $new_order;
    }

    public function declare_play_offs($play_offs_qtt, $no_last_place) {
        $this->set_play_offs_qtt($play_offs_qtt);
        $this->set_no_last_place($no_last_place);
        $this->play_offs = new Play_offs($this->play_offs_qtt, $this->no_last_place);
        $this->play_offs->create_structure();
        $this->play_offs->create_place_matches();
        $this->play_offs->fill_structure_from_group($this->play_offs_preparation()); //if groups are available!!!
    }

    public function teams_qtt_in_group() {
        return intval($this->participants_qtt / $this->group_qtt);
    }

    //CONSTRUCTORS

    public function __construct($name, $participants_qtt, $start_time, $end_time) {
        $this->name = $name;
        $this->participants_qtt = $participants_qtt;
        $this->host = new Entity();
        $this->sponsor = new Entity();
        $this->declare_teams();
        $this->set_start_date($start_time);
        $this->set_end_date($end_time);
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

// --------------------------------------------------------------------
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>GROUP<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// --------------------------------------------------------------------

class Group {

    private $id;
    public $name;
    public $teams_qtt;
    public $teams = array();
    public $result; //aktualna tabela
    public $promoted_teams_qtt;
    private $matches = array();

    //SET

    public function set_name($arg) {
        $this->name = $arg;
    }

    public function set_teams_qtt($arg) {
        $this->teams_qtt = $arg;
    }

    public function set_promoted_teams_qtt($arg) {
        $this->promoted_teams_qtt = $arg;
    }

    public function set_teams($arg) {
        $this->teams = $arg;
    }

    public function set_id($arg) {
        $this->id = $arg;
    }

    //GET

    public function get_name() {
        return $this->name;
    }

    public function get_teams_qtt() {
        return $this->teams_qtt;
    }

    public function get_promoted_teams_qtt() {
        return $this->promoted_teams_qtt;
    }

    public function get_teams() {
        return $this->teams;
    }

    public function get_matches() {
        return $this->matches;
    }

    public function get_id() {
        return $this->id;
    }

    //FUNCTIONS

    public function promoted_teams() {
        $promoted = array();
        for ($i = 0; $i < $this->promoted_teams_qtt; $i++) {
            array_push($promoted, $this->teams[$i]);
        }
        return $promoted;
    }

    public function promoted_teams_qtt($groups, $play_off) {
        $this->promoted_teams_qtt = ($play_off * 2) / $groups;
    }

    public function create_matches() {
        for ($i = 0; $i < count($this->teams) - 1; $i++) {
            for ($j = $i + 1; $j < count($this->teams); $j++) {
                $group_match = new Match();
                $group_match->set_team1($this->teams[$i]);
                $group_match->set_team2($this->teams[$j]);
                array_push($this->matches, $group_match);
            }
        }
    }

    public function count_results() {
        foreach ($this->matches as $key => $match) {
            
        }
    }

    //CONSTRUCTOR

    public function __construct($name, $teams_qtt) {
        $this->name = $name;
        $this->teams_qtt = $teams_qtt;
    }

}

// --------------------------------------------------------------------
// >>>>>>>>>>>>>>>>>>>>>>>>>>GROUP TABLE<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// --------------------------------------------------------------------

class Group_table {

    private $id;
    public $team;
    public $points;
    public $wins;
    public $loses;
    public $draws;
    public $scores;
    public $lost_goals;

    //SET

    public function set_id($arg) {
        $this->id = $arg;
    }

    //GET
    public function get_id() {
        return $this->id;
    }

}

// --------------------------------------------------------------------
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>PLAY-OFFS<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// --------------------------------------------------------------------

class Play_offs {

    //public $name;
    private $id;
    public $rounds_qtt;
    public $no_last_place;
    public $rounds = array(); //key=round; values=matches(array)
    public $places = array(); //key=round; values=matches(array)
    public $matches = array();
    public $round = array(1 => "Finał", 2 => "Półfinał", 4 => "Ćwierćfinał", 8 => "1/16", 16 => "1/32");

    //SET

    public function set_id($arg) {
        $this->id = $arg;
    }

    //GET

    public function get_id() {
        return $this->id;
    }

    public function create_structure() {
        for ($i = $this->rounds_qtt; $i >= 1; $i /= 2) {
            $this->rounds[$this->round[$i]] = array();
            for ($j = 0; $j < $i; $j++) {
                $this->rounds[$this->round[$i]][$j] = new Match();
                //set name of play-off
                if ($i != 1) {
                    $this->rounds[$this->round[$i]][$j]->set_name($this->round[$i]);
                } else {
                    $this->rounds[$this->round[$i]][$j]->set_name($this->round[$i]); //when final
                }
            }
        }
    }

    public function fill_structure_from_group($groups) {
        $j = 0;
        for ($i = 0; $i < $this->rounds_qtt; $i++) {
            $this->rounds[$this->round[$this->rounds_qtt]][$i]->set_team1($groups[$j]->get_team1());

            if ($groups[$j]->get_team2()->get_name() !== null) {
                $this->rounds[$this->round[$this->rounds_qtt]][$i]->set_team2($groups[$j++]->get_team2());
            } else {//when there's only one team promoted from each group
                $this->rounds[$this->round[$this->rounds_qtt]][$i]->set_team2($groups[++$j]->get_team1());
                $j++;
            }
        }
    }

    public function create_place_matches() {
        for ($i = $this->no_last_place; $i > 1; $i -= 2) {
            $this->places[$i] = new Match();
        }
    }

    public function __construct($rounds_qtt, $no_last_place) {
        $this->rounds_qtt = $rounds_qtt;
        $this->no_last_place = $no_last_place;
    }

}

// --------------------------------------------------------------------
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>MATCH<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// --------------------------------------------------------------------

class Match {

    private $id;
    private $name;
    private $team1;
    private $team2;
    private $result = array();

    //SET
    public function set_name($arg) {
        $this->name = $arg;
    }

    public function set_team1($arg) {
        $this->team1 = $arg;
    }

    public function set_team2($arg) {
        $this->team2 = $arg;
    }

    public function set_result($home, $away) {
        $this->result[0] = $home;
        $this->result[1] = $away;
    }

    public function set_id($arg) {
        $this->id = $arg;
    }

    //GET
    public function get_name() {
        return $this->name;
    }

    public function get_team1() {
        return $this->team1;
    }

    public function get_team2() {
        return $this->team2;
    }

    public function get_result() {
        return $this->result;
    }

    public function get_id() {
        return $this->id;
    }

    //functions

    public function winner() {
        if ($this->result[0] > $this->result[1]) {
            return $this->team1;
        } else {
            return $this->team2;
        }
    }

    //constructor

    public function __construct() {
        $this->team1 = new Team();
        $this->team2 = new Team();
        $this->set_result(1, 1);
    }

}

// --------------------------------------------------------------------
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>TEAM<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// --------------------------------------------------------------------

class Team {

    private $name;
    private $id;

    //SET
    public function set_name($arg) {
        $this->name = $arg;
    }

    public function set_id($arg) {
        $this->id = $arg;
    }

    //SET
    public function get_name() {
        return $this->name;
    }

    public function get_id() {
        return $this->id;
    }

}

// --------------------------------------------------------------------
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>ENTITY<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// --------------------------------------------------------------------

class Entity {

    private $name;
    private $logo;
    private $url;

    //SET
    public function set_name($arg) {
        $this->name = $arg;
    }

    public function set_logo($arg) {
        $this->logo = $arg;
    }

    public function set_url($arg) {
        $this->url = $arg;
    }

    //GET
    public function get_name() {
        return $this->name;
    }

    public function get_logo() {
        return $this->logo;
    }

    public function get_url() {
        return $this->url;
    }

    /*
      public function __construct($name, $logo, $url) {
      $this->name = $name;
      $this->logo = $logo;
      $this->url = $url;
      }
     */

    public function __construct() {
        
    }

}
