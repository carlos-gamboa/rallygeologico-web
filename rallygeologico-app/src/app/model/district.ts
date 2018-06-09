import {Canton} from "./canton";

export class District {
    id : number;
    name : number;
    canton_id: number;
    canton : Canton;

    constructor(district: any){
        this.id = district.id;
        this.name = district.name;
        this.canton_id = district.canton_id;
        this.canton = district.canton;
    }
}