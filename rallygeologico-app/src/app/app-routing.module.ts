import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent} from "./login/login.component";
import {RouterModule, Routes} from "@angular/router";




const routes : Routes = [
  //path: '', component: LandingComponent}
  {path: 'login', component: LoginComponent}
];







@NgModule({
  imports: [ RouterModule.forRoot( routes, {enableTracing: true})],
  exports: [RouterModule],
  declarations: []
})
export class AppRoutingModule { }
