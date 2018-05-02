import {Configuration} from "./data/constants";
import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Competition} from "../model/competition";

@Injectable()
export class CompetitionService {

    baseUrl: string;

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    createCompetition(isPublic: string, startingDate: string, finishingDate: string, name: string, rallyId: string): Observable<Competition[]>{
        return this.http.post<Competition[]>(this.baseUrl + "competition/add", {
            //'starting_date': JSON.stringify(new Date(startingDate)),
            //'finishing_date': new Date(finishingDate),
            'starting_date': startingDate,
            'finishing_date': finishingDate,
            'is_public': isPublic,
            'name': name,
            'rally_id': rallyId
            }
        );
    }

    findCompetition(competitionId: number) : Observable<Competition>{
        return this.http.get<Competition>(this.baseUrl + "competition/view/"+ competitionId +".json");
    }
}