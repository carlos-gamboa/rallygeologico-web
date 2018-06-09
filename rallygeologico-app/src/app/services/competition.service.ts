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
     * @param {number} competitionId Competition Id
     * @returns {Observable<Competition>}
     */
    findCompetition(competitionId: number) : Observable<Competition>{
        return this.http.get<Competition>(this.baseUrl + "competition/view/"+ competitionId +".json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for getting the current competition.
     * @param {number} userId
     * @returns {Observable<Competition[]>}
     */
    getCurrentCompetitions(userId: number): Observable<Competition[]>{
        return this.http.get<Competition[]>(this.baseUrl + "competition/currentCompetitions/"+ userId +".json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for getting all the public competitions that the user is not participating in already.
     * @param {number} user_id User's id.
     * @returns {Observable<Competition[]>}
     */
    getAllPublicCompetitions(user_id:number): Observable<Competition[]>{
        return this.http.get<Competition[]>(this.baseUrl + "competition/getallpubliccompetitions/"+user_id+".json",{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for getting all the competitions
     *
     * @returns {Observable<Competition[]>}
     */
    getAllCompetitions(): Observable<Competition[]>{
        return this.http.get<Competition[]>(this.baseUrl + "competition.json",{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for editing a competition
     *
     * @param {number} id
     * @param {string} name
     * @param {string} isActive
     * @param {string} isPublic
     * @param {string} description
     * @param {string} startingDate
     * @param {string} finishingDate
     * @param rallyId
     * @param {string} adminId
     * @returns {Observable<Competition>}
     */
    editCompetition(id: number, name: string, isActive: string, isPublic: string, description: string, startingDate: string, finishingDate: string, rallyId, adminId: string): Observable<Competition>{
        return this.http.post<Competition>(this.baseUrl + "competition/edit/" + id + ".json", {
            'is_active': isActive,
            'is_public': isPublic,
            'admin_id': adminId,
            'description': description,
            'name': name,
            'rally_id': rallyId,
            'starting_date': startingDate,
            'finishing_date': finishingDate
        },{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for creating a competition
     *
     * @param {string} name
     * @param {string} isActive
     * @param {string} isPublic
     * @param {string} description
     * @param {string} startingDate
     * @param {string} finishingDate
     * @param rallyId
     * @param {string} adminId
     * @returns {Observable<Competition>}
     */
    adminAddCompetition(name: string, isActive: string, isPublic: string, description: string, startingDate: string, finishingDate: string, rallyId, adminId: string): Observable<Competition>{
        return this.http.post<Competition>(this.baseUrl + "competition/add.json", {
            'is_active': isActive,
            'is_public': isPublic,
            'admin_id': adminId,
            'description': description,
            'name': name,
            'rally_id': rallyId,
            'starting_date': startingDate
        },{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for deleting a competition
     *
     * @param {number} id
     * @returns {Observable<boolean>}
     */
    deleteCompetition(id: number): Observable<boolean>{
        return this.http.delete<boolean>(this.baseUrl + "competition/delete/"+id+".json");
    }

}