export class Province {
    id : number;
    name : string;

    constructor(province: any){
        this.id = province.id;
        this.name = province.name;
    }
}