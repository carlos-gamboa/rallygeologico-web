export class Site {
    id: number;
    name:  string;
    points_awarded: number;
    qr_url: string;
    details: string;
    description: string;
    latitude: number;
    longitude: number;
    province_id: string;

    constructor(site: any){
        this.id = site.id;
        this.name = site.name;
        this.points_awarded = site.points_awarded;
        this.qr_url = site.qr_url;
        this.details = site.details;
        this.description = site.description;
        this.latitude = site.latitude;
        this.longitude = site.longitude;
        this.province_id = site.province_id;
    }
}