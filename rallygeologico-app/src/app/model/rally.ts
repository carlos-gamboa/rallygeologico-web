export class Rally {
    id: number;
    name:  string;
    points_awarded: number;
    image_url: string;
    description: string;

    constructor(rally: any){
        this.id = rally.id;
        this.name = rally.name;
        this.points_awarded = rally.points_awarded;
        this.image_url = rally.image_url;
        this.description = rally.description;
    }
}