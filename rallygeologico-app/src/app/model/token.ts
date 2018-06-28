import {User} from "./user";

export class Token {
    id: number;
    value:  string;
    is_valid: string;
    created: string;
    type: string;
    user: User;

    constructor(token: any){
        this.id = token.id;
        this.value = token.value;
        this.is_valid = token.is_valid;
        this.created = token.created;
        this.type = token.type;
        this.user = token.user;
    }
}