import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {CompetitionStatistics} from "../model/competition.statistics";
import {User} from "../model/user";
import {Competition} from "../model/competition";
import {District} from "../model/district";

@Injectable()
export class DistrictService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    /**
     * Creates a District Service
     * @param {HttpClient} http
     * @param {Configuration} _configuration
     */
    constructor(private http: HttpClient, private _configuration: Configuration) {
        this.baseUrl = this._configuration.ServerWithApiUrl;
        this.headers.append('Content-Type', 'application/json');
    }

    /**
     * Service for getting all the districts
     *
     * @returns {Observable<District[]>}
     */
    getAllDistricts(): Observable<District[]>{
        return this.http.get<District[]>(this.baseUrl + "district.json",{ headers: this.headers, withCredentials: true })
    }
}