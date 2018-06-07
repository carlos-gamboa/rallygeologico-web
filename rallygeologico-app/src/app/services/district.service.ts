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

    editDistrict(id:number, name:string ,canton_id:number): Observable<District>{
            return this.http.post<District>(this.baseUrl + "competition/edit/" + id + ".json", {
                'name': name,
                'canton_id': canton_id
            },{ headers: this.headers, withCredentials: true });
    }

    addDistrict(name:string, canton_id:number): Observable<District> {
        return this.http.post<District>(this.baseUrl + "district/add.json", {
            'name': name,
            'canton_id':canton_id
        },{ headers: this.headers, withCredentials: true });
    }

    deleteDistrict(id:number): Observable<boolean> {
        return this.http.delete<boolean>(this.baseUrl + "district/delete/"+id+".json");
    }


}