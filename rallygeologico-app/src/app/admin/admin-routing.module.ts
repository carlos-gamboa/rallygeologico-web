import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {AdminComponent} from "./admin.component";
import {LoginComponent} from "./login/login.component";
import {EditCompetitionComponent} from "./edit-competition/edit-competition.component";

const routes : Routes = [
    { path: '', component: AdminComponent, children: [
        {
            path : 'admin', component: LoginComponent, children: [
                {
                    path: 'competition', component: EditCompetitionComponent
                }
            ]
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
