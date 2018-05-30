import {Rally} from "./rally";
import {User} from "./user";
import {Invitation} from "./invitation";

export class Competition {
    id: number;
    is_active: number;
    starting_date: string;
    finishing_date: string;
    is_public: number;
    name:  string;
    rally_id: number;
    admin_id: number;
    description: string;
    rally: Rally;
    user: User;
    invitation: Invitation[];


    constructor(competition: any){
        this.id = competition.id;
        this.is_active = competition.is_active;
        this.starting_date = competition.starting_date;
        this.finishing_date = competition.finishing_date;
        this.is_public = competition.is_public;
        this.name = competition.name;
        this.rally_id = competition.rally_id;
        this.admin_id = competition.admin_id;
        this.rally = competition.rally;
        this.user = competition.user;
        this.description = competition.description;
        this.invitation = competition.invitation;
    }
}