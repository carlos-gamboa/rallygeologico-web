import {Province} from "./province";

export class Canton {
    id : number;
    name : string;
    province_id: number;
    province : Province;

    constructor(canton: any){
        this.id = canton.id;
        this.name = canton.name;
        this.province_id = canton.province_id;
        this.province = canton.province;
    }
}