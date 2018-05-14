import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {CompetitionStatistics} from "../model/competition.statistics";
import {User} from "../model/user";
import {Competition} from "../model/competition";

@Injectable()
export class CompetitionStatisticsService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    /**
     * Creates a Competition Service
     * @param {HttpClient} http
     * @param {Configuration} _configuration
     */
    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
        this.headers.append('Content-Type', 'application/json');
    }

    /**
     * Service for adding a new competition statistics to the database, creates a post request with the attributes in the body
     * @param {number} user
     * @param {number} competition
     * @returns {Observable<Competition>}
     */
    createCompetitionStatistics(userId: number, competitionId: number): Observable<CompetitionStatistics>{
        return this.http.post<CompetitionStatistics>(this.baseUrl + "competitionStatistics/add.json", {
                'user_id': userId,
                'competition_id': competitionId
            },{ headers: this.headers, withCredentials: true }
        );
    }

    getStatistics(competitionId:number): Observable<CompetitionStatistics[]>{
        return this.http.get<CompetitionStatistics[]>(this.baseUrl + "competitionStatistics/getCompetitionStatistics/" + competitionId + ".json",
            { headers: this.headers, withCredentials: true }
        );
    }
}