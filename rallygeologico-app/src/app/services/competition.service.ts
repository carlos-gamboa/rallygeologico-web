import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Competition} from "../model/competition";
import {Invitation} from "../model/invitation";

@Injectable()
export class CompetitionService {

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
     * Service for adding a new competition to the database, creates a post request with the attributes in the body
     * @param {string} isPublic
     * @param {number} adminId
     * @param {string} description
     * @param {string} name
     * @param {string} rallyId
     * @returns {Observable<Competition>}
     */
    createCompetition(isPublic: string, adminId: number,  description: string, name: string, rallyId: string): Observable<Competition>{
        return this.http.post<Competition>(this.baseUrl + "competition/add.json", {
            'is_public': isPublic,
            'admin_id': adminId,
            'description': description,
            'name': name,
            'rally_id': rallyId
            },{ headers: this.headers, withCredentials: true }
        );
    }

    /**
     * Service for getting a competition from the database, using the id in the url as a parameter
     * @param {number} competitionId
     * @returns {Observable<Competition>}
     */
    findCompetition(competitionId: number) : Observable<Competition>{
        return this.http.get<Competition>(this.baseUrl + "competition/view/"+ competitionId +".json",{ headers: this.headers, withCredentials: true });
    }

    getCurrentCompetitions(userId: number): Observable<Competition[]>{
        return this.http.get<Competition[]>(this.baseUrl + "competition/currentCompetitions/"+ userId +".json",{ headers: this.headers, withCredentials: true });
    }

    getAllPublicCompetitions(): Observable<Competition[]>{
        return this.http.get<Competition[]>(this.baseUrl + "competition/getallpubliccompetitions.json",{ headers: this.headers, withCredentials: true })
    }

}