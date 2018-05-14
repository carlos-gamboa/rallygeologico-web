export class User {
    id: number;
    facebook_id: string;
    username:  string;
    first_name: string;
    last_name: string;
    photo_url: string;

    constructor(user: any){
        this.id = user.id;
        this.facebook_id = user.facebook_id;
        this.username = user.username;
        this.first_name = user.first_name;
        this.last_name = user.last_name;
        this.photo_url = user.photo_url;
    }
}