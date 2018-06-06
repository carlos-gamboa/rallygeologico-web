import {District} from "./district";

export class Site {
    id: number;
    name:  string;
    qr_url: string;
    details: string;
    description: string;
    latitude: number;
    longitude: number;
    district_id: string;
    points: number;
    is_easter_egg: string;
    district: District;

    constructor(site: any){
        this.id = site.id;
        this.name = site.name;
        this.qr_url = site.qr_url;
        this.details = site.details;
        this.description = site.description;
        this.latitude = site.latitude;
        this.longitude = site.longitude;
        this.district_id = site.district_id;
        this.points = site.points;
        this.is_easter_egg = site.is_easter_egg;
        this.district = site.district;
    }
}