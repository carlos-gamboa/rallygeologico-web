import {Configuration} from "./data/constants";
import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Invitation} from "../model/invitation";

@Injectable()
export class InvitationService {

    baseUrl: string;

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    sendInvitation(userIdSend: number, userIdReceive: number, competitionId: number): Observable<Invitation[]>{
        return this.http.post<Invitation[]>(this.baseUrl + "invitation/add.json",{
            'user_id_send' : userIdSend,
            'user_id_receive' : userIdReceive,
            'competition_id' : competitionId,
        });
    }

    getInvitations(userIdReceive: number): Observable<Invitation[]>{
        return this.http.get<Invitation[]>(this.baseUrl + "invitation/receive/"+ userIdReceive +".json");
    }
}