import { NgModule } from '@angular/core';
import { LoginComponent} from "./login/login.component";
import {RouterModule, Routes} from "@angular/router";


const routes : Routes = [
    {
        path: '', redirectTo: 'login', pathMatch: 'full'
    },
    {
        path: 'login', component: LoginComponent
    }
];

@NgModule({
  imports: [ RouterModule.forRoot(
      routes,{enableTracing: true}
      )],
  exports: [RouterModule],
  declarations: []
})
export class AppRoutingModule { }
