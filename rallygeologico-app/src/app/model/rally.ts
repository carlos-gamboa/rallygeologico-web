export class Rally {
    RallyId: number;
    Name:  string;
    PointsAwarded: number;
    ImageUrl: string;
    Description: string;

    constructor(rally: any){
        this.RallyId = rally.RallyId;
        this.Name = rally.Name;
        this.PointsAwarded = rally.PointsAwarded;
        this.ImageUrl = rally.ImageUrl;
        this.Description = rally.Description;
    }
}