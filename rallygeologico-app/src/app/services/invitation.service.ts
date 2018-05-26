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

    /**
     * Service for sending an invitation to another user.
     * @param {number} userIdSend Id of the user that sends the invitation
     * @param {number} userIdReceive Id of the user that receives the invitation
     * @param {number} competitionId Id of the competition
     * @returns {Observable<Invitation>}
     */
    sendInvitation(userIdSend: number, userIdReceive: number, competitionId: number): Observable<Invitation>{
        return this.http.post<Invitation>(this.baseUrl + "invitation/add.json",{
            'user_id_send' : userIdSend,
            'user_id_receive' : userIdReceive,
            'competition_id' : competitionId,
        },{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for getting all the invitations associated with an user
     * @param {number} userIdReceive Id of the receiver.
     * @returns {Observable<Invitation[]>}
     */
    getInvitations(userIdReceive: number): Observable<Invitation[]>{
        return this.http.get<Invitation[]>(this.baseUrl + "invitation/receive/"+ userIdReceive +".json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for getting an invitation based on a user Id and competition Id.
     * @param {number} userIdReceive Id of the receiver.
     * @param {number} competitionId Id of the competition
     * @returns {Observable<Invitation[]>}
     */
    getInvitation(userIdReceive: number, competitionId: number): Observable<Invitation[]>{
        return this.http.post<Invitation[]>(this.baseUrl + "invitation/userCompetitionInvitation.json",{
            'user_id_receive' : userIdReceive,
            'competition_id' : competitionId,
        },{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for editing an invitation
     * @param {number} id Id of the invitation
     * @param {number} accepted Whether the invitation is accepted or not.
     * @param {number} rejected Whether the invitation is rejected or not.
     * @returns {Observable<Invitation>}
     */
    editInvitation(id: number, accepted: number, rejected: number): Observable<Invitation>{
        return this.http.post<Invitation>(this.baseUrl + "invitation/edit/"+id+".json",{
            'accepted' : accepted,
            'rejected' : rejected
        },{ headers: this.headers, withCredentials: true });
    }
}