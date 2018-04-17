import { NgModule } from '@angular/core';
import { LoginComponent} from "./login/login.component";
import {RouterModule, Routes} from "@angular/router";
import {LandingComponent} from "./landing/landing.component";

const routes : Routes = [
    { path: '', redirectTo: 'landing', pathMatch: 'full' },
    { path: 'login', component: LoginComponent },
    { path: 'landing', component: LandingComponent }
];

@NgModule({
  imports: [ RouterModule.forRoot(
      routes,{enableTracing: true}
      )],
  exports: [RouterModule],
  declarations: []
})
export class AppRoutingModule { }
