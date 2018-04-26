export class Competition {
    id: number;
    IsActive: boolean;
    StartingDate: string;
    FinishingDate: string;
    IsPublic: boolean;
    Name:  string;
    RallyId: number;

    constructor(competition: any){
        this.id = competition.id;
        this.IsActive = competition.IsActive;
        this.StartingDate = competition.StartingDate;
        this.FinishingDate = competition.FinishingDate;
        this.IsPublic = competition.IsPublic;
        this.Name = competition.Name;
        this.RallyId = competition.RallyId;
    }
}