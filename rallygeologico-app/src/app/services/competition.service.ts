import {Configuration} from "./data/constants";
import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Competition} from "../model/competition";
import {Observable} from "rxjs/Observable";

@Injectable()
export class CompetitionService {

    baseUrl: string;

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    createCompetition(): Observable<Competition>{
        return this.http.get<Competition>(this.baseUrl + "competition/add.json");
    }
}