import {Site} from "./site";
import {Competition} from "./competition";

export class Rally {
    id: number;
    name:  string;
    points_awarded: number;
    image_url: string;
    description: string;
    latitude: number;
    longitude: number;
    site: Site[];
    competition: Competition[];

    constructor(rally: any){
        this.id = rally.id;
        this.name = rally.name;
        this.points_awarded = rally.points_awarded;
        this.image_url = rally.image_url;
        this.description = rally.description;
        this.latitude = rally.latitude;
        this.longitude = rally.longitude;
        for (let site of rally.site){
            this.site.push(site);
        }
        for (let competition of rally.competition){
            this.competition.push(competition);
        }
    }
}