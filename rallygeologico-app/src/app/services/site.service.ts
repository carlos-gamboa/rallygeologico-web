import {Configuration} from "./data/constants";
import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Site} from "../model/site";

@Injectable()
export class SiteService {

    baseUrl: string;

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    /**
     * Service for getting a specific site from database, creates a get request with the id as a parameter
     * @param {number} id
     * @returns {Observable<Site>}
     */
    getSite(id: number): Observable<Site>{
        return this.http.get<Site>(this.baseUrl + "site/view/"+id+".json");
    }

    /**
     * Service for getting all the sites those aren't part of the specified rally
     * @param {number} rallyId
     * @returns {Observable<Site>}
     */
    getOtherSites(rallyId: number):Observable<Site[]>{
        return this.http.get<Site[]>(this.baseUrl + "site/getOtherSites/"+rallyId+".json");
    }
}