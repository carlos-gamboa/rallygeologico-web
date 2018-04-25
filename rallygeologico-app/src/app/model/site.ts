export class Site {
    SiteId: number;
    Name:  string;
    PointsAwarded: number;
    QrUrl: string;
    Details: string;
    Description: string;
    Latitude: number;
    Longitude: number;
    ProvinceName: string;

    constructor(site: any){
        this.SiteId = site.SiteId;
        this.Name = site.Name;
        this.PointsAwarded = site.PointsAwarded;
        this.QrUrl = site.QrUrl;
        this.Details = site.Details;
        this.Description = site.Description;
        this.Latitude = site.Latitude;
        this.Longitude = site.Longitude;
        this.ProvinceName = site.ProvinceName;
    }
}