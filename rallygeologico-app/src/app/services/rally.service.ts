import {Configuration} from "./data/constants";
import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Rally} from "../model/rally";
import {Observable} from "rxjs/Observable";

@Injectable()
export class RallyService {

    baseUrl: string;

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    getNewestRallies(): Observable<Rally[]>{
        return this.http.get<Rally[]>(this.baseUrl + "rally/newestRallies.json");
    }

    /**
     * Service for getting a specific rally from database, creates a get request with the id as a parameter
     * @param {number} id
     * @returns {Observable<Rally>}
     */
    getRally(id: number): Observable<Rally>{
        return this.http.get<Rally>(this.baseUrl + "rally/view/"+id+".json");
    }
}