import {User} from "./user";
import {Competition} from "./competition";

export class CompetitionStatistics {
    user_id: number;
    competition_id: number;
    starting_date: string;
    finishing_date: string;
    points: number;
    competition: Competition;
    user: User;


    constructor(competitionStatistics: any){
        this.user_id = competitionStatistics.user_id;
        this.competition_id = competitionStatistics.competition_id;
        this.starting_date = competitionStatistics.starting_date;
        this.finishing_date = competitionStatistics.finishing_date;
        this.points = competitionStatistics.points;
        this.competition = competitionStatistics.competition;
        this.user = competitionStatistics.user;
    }
}