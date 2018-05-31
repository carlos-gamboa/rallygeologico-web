import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {UserComponent} from "./user.component";
import {DashboardComponent} from "./dashboard/dashboard.component";
import {ProfileComponent} from "./profile/profile.component";
import {CompetitionComponent} from "./competition/competition.component";
import {CreateCompetitionComponent} from "./create-competition/create-competition.component";
import {SearchRalliesComponent} from "./search-rallies/search-rallies.component";

const routes : Routes = [
    { path: '', component: UserComponent, children: [
            {
                path : 'dashboard', component: DashboardComponent,
            },
            {
                path : 'profile/:userId', component: ProfileComponent
            },
            {
                path : 'competition/:competitionId', component: CompetitionComponent
            },
            {
                path : 'create-competition', component: CreateCompetitionComponent
            },
            {
                path : 'search-rallies',component: SearchRalliesComponent
            }
        ]
    },
];

@NgModule({
    imports : [RouterModule.forChild(
        routes
    )],
    exports : [RouterModule],
    providers : []
})

export class UserRoutingModule{}
