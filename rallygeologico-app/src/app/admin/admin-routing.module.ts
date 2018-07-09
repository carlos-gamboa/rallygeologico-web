import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {AdminComponent} from "./admin.component";
import {LoginComponent} from "./login/login.component";
import {EditCompetitionComponent} from "./edit-competition/edit-competition.component";
import {EditRallyComponent} from "./edit-rally/edit-rally.component";
import {EditSiteComponent} from "./edit-site/edit-site.component";
import {EditCantonComponent} from "./edit-canton/edit-canton.component";
import {EditDistrictComponent} from "./edit-district/edit-district.component";
import {EditTermComponent} from "./edit-term/edit-term.component";
import {EditUsersComponent} from "./edit-users/edit-users.component";
import {EditMultimediaComponent} from "./edit-multimedia/edit-multimedia.component";
import {EditActivityComponent} from "./edit-activity/edit-activity.component";

const routes : Routes = [
    { path: 'admin', component: AdminComponent, children: [
        {
            path : '', component: LoginComponent
        },
        {
            path: 'competition', component: EditCompetitionComponent
        },
        {
            path: 'term', component: EditTermComponent
        },
        {
            path: 'site', component: EditSiteComponent
        },
        {
            path: 'district', component: EditDistrictComponent
        },
        {
            path: 'canton', component: EditCantonComponent
        },
        {
            path: 'rally', component: EditRallyComponent
        },
        {
            path: 'users', component: EditUsersComponent
        },
        {
            path: 'multimedia', component: EditMultimediaComponent
        },
        {
            path: 'activity', component: EditActivityComponent
        }
    ]},
];

@NgModule({
  imports : [RouterModule.forChild(
    routes
  )],
  exports : [RouterModule],
  providers : []
})

export class AdminRoutingModule{}
