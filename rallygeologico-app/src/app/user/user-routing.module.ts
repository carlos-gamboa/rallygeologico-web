import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {UserComponent} from "./user.component";
import {DashboardComponent} from "./dashboard/dashboard.component";
import {ProfileComponent} from "./profile/profile.component";
import {CompetitionComponent} from "./competition/competition.component";

const routes : Routes = [
    { path: '', component: UserComponent, children: [
            {
                path : 'dashboard', component: DashboardComponent,
            },
            {
                path : 'profile', component: ProfileComponent
            },
            {
                path : 'competition/:competitionId', component: CompetitionComponent
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