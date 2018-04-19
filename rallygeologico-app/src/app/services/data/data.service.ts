import {Injectable} from "@angular/core";
import {User} from "../../model/user";

@Injectable()
export class DataService {

    user: User;

    constructor() {

    }

    updateUser(user: User){
        this.user = user;
    }

    getUser(){
        return this.user;
    }

}