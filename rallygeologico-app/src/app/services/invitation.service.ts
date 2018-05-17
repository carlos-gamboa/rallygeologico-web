import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Invitation} from "../model/invitation";

@Injectable()
export class InvitationService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
        this.headers.append('Content-Type', 'application/json');
    }

    sendInvitation(userIdSend: number, userIdReceive: number, competitionId: number): Observable<Invitation[]>{
        return this.http.post<Invitation[]>(this.baseUrl + "invitation/add.json",{
            'user_id_send' : userIdSend,
            'user_id_receive' : userIdReceive,
            'competition_id' : competitionId,
        },{ headers: this.headers, withCredentials: true });
    }

    getInvitations(userIdReceive: number): Observable<Invitation[]>{
        return this.http.get<Invitation[]>(this.baseUrl + "invitation/receive/"+ userIdReceive +".json",{ headers: this.headers, withCredentials: true });
    }

    getInvitation(userIdReceive: number, competitionId: number): Observable<Invitation[]>{
        return this.http.post<Invitation[]>(this.baseUrl + "invitation/userCompetitionInvitation.json",{
            'user_id_receive' : userIdReceive,
            'competition_id' : competitionId,
        },{ headers: this.headers, withCredentials: true });
    }

    editInvitation(id: number, accepted: number, rejected: number): Observable<Invitation>{
        return this.http.post<Invitation>(this.baseUrl + "invitation/edit/"+id+".json",{
            'accepted' : accepted,
            'rejected' : rejected
        },{ headers: this.headers, withCredentials: true });
    }
}