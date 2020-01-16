class Tournament {
    name;
    host_logo;
    host_url;
    sponsor_name;
    sponsor_url;
    sponsor_logo;
    participants_no;
    
    group = array();
    play_offs;
    mode; //0-group; 1-play-offs; 2-both
    constructor(mode) {
        this.mode = mode;
    }
}

class Group {
    
    name;
    teams = array();
    result;

}

class Play_offs {
    
    rounds;
    matches = array();
    revanges;

}

class Match {

    team1;
    team2;
    result;

}

class Group_table {

    team;
    points;
    wins;
    loses;
    draws;
    scores;
    lost_goals;

}

class Team {

}