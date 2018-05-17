export class Activity {
    id: number;
    site_id: number;
    activity_type: number;
    points_awarded: number;
    description: string;


    constructor(activity: any){
        this.id = activity.id;
        this.site_id = activity.site_id;
        this.activity_type = activity.activity_type;
        this.points_awarded = activity.points_awarded;
        this.description = activity.description;
    }
}