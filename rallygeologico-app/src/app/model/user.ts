export class User {
    UserId: number;
    FacebookId: string;
    Username:  string;
    FirstName: string;
    LastName: string;
    PhotoURL: string;

    constructor(user: any){
        this.UserId = user.UserId;
        this.FacebookId = user.FacebookId;
        this.Username = user.Username;
        this.FirstName = user.FirstName;
        this.LastName = user.LastName;
        this.PhotoURL = user.PhotoURL;
    }
}