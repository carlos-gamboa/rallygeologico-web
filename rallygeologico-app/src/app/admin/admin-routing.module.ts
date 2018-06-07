import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {AdminComponent} from "./admin.component";
import {LoginComponent} from "./login/login.component";
import {EditCompetitionComponent} from "./edit-competition/edit-competition.component";
import {EditSiteComponent} from "./edit-site/edit-site.component";
import {EditCantonComponent} from "./edit-canton/edit-canton.component";
import {EditDistrictComponent} from "./edit-district/edit-district.component";

const routes : Routes = [
    { path: 'admin', component: AdminComponent, children: [
        {
            path : '', component: LoginComponent
        },
        {
            path: 'competition', component: EditCompetitionComponent
        },
        {
            path: 'site', component: EditSiteComponent
        },
        {
            path: 'district', component: EditDistrictComponent
        },
        {
            path: 'canton', component: EditCantonComponent
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
