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
    }
}