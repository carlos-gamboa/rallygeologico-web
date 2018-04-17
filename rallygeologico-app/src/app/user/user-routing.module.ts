import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {UserComponent} from "./user.component";
import {DashboardComponent} from "./dashboard/dashboard.component";
import {ProfileComponent} from "./profile/profile.component";
import {GlossaryComponent} from "./glossary/glossary.component";

const routes : Routes = [
    { path: 'dashboard', component: UserComponent, children: [
            {
                path : '', component: DashboardComponent,
            },
            {
                path : 'glossary', component: GlossaryComponent
            }
            ,
            {
                path : 'profile', component: ProfileComponent
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