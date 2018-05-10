import {User} from "./user";
import {Competition} from "./competition";

export class Invitation {
    id : number;
    accepted : boolean;
    rejected: boolean;
    user_id_send : number;
    user_id_receive : number;
    competition_id : number;
    user_send: User;
    competition: Competition;

    constructor(invitation: any){
        this.id = invitation.id;
        this.accepted = invitation.accepted;
        this.rejected = invitation.rejected;
        this.user_id_send = invitation.user_id_send;
        this.user_id_receive = invitation.user_id_receive;
        this.competition_id = invitation.competition_id;
        this.user_send = invitation.user_send;
        this.competition = invitation.competition;
    }
}