export class User {
    FacebookId: number;
    Username:  string;
    FirstName: string;
    LastName: string;
    PhotoURL: string;

    constructor(user: any){
        this.FacebookId = user.FacebookId;
        this.Username = user.Username;
        this.FirstName = user.FirstName;
        this.LastName = user.LastName;
        this.PhotoURL = user.PhotoURL;
    }
}