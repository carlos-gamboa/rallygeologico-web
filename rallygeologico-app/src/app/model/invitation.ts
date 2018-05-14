export class Invitation {
    id : number;
    accepted : boolean;
    user_id_send : number;
    user_id_receive : number;
    competition_id : number;

    constructor(invitation: any){
        this.id = invitation.id;
        this.accepted = invitation.accepted;
        this.user_id_send = invitation.user_id_send;
        this.user_id_receive = invitation.user_id_receive;
        this.competition_id = invitation.competition_id;
    }
}