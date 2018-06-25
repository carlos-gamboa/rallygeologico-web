export class User {
    id: number;
    username:  string;
    first_name: string;
    last_name: string;
    photo_url: string;
    is_admin: number;
    login_api: number;
    is_active: string;
    api_id: string;
    email: string;
    password_needs_change: string;


    constructor(user: any){
        this.id = user.id;
        this.username = user.username;
        this.first_name = user.first_name;
        this.last_name = user.last_name;
        this.photo_url = user.photo_url;
        this.is_admin = user.is_admin;
        this.login_api = user.login_api;
        this.is_active = user.is_active;
        this.api_id = user.api_id;
        this.email = user.email;
        this.password_needs_change = user.password_needs_change;
    }
}
