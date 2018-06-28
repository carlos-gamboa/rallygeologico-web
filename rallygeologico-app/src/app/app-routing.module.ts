import { NgModule } from '@angular/core';
import { LoginComponent} from "./login/login.component";
import {RouterModule, Routes} from "@angular/router";
import {LandingComponent} from "./landing/landing.component";
import {RallyComponent} from "./rally/rally.component";
import {AboutUsComponent} from "./about-us/about-us.component";
import {GlossaryComponent} from "./glossary/glossary.component";
import {RalliesComponent} from "./rallies/rallies.component";
import {InstructionsComponent} from "./instructions/instructions.component";
import {DefinitionComponent} from "./definition/definition.component";
import {RegisterComponent} from "./register/register.component";
import {SiteComponent} from "./site/site.component";
import {ForgotPasswordComponent} from "./forgot-password/forgot-password.component";
import {TokenLandingComponent} from "./token-landing/token-landing.component";

const routes : Routes = [
    {
        path: '', redirectTo: 'landing', pathMatch: 'full'
    },
    {
        path: 'sign-in', component: LoginComponent
    },
    {
        path: 'register', component: RegisterComponent
    },
    {
        path: 'landing', component: LandingComponent
    },
    {
        path : 'about_us', component: AboutUsComponent
    },
    {
        path : 'glossary', component: GlossaryComponent
    },
    {
        path : 'glossary/:definitionId', component: DefinitionComponent
    },
    {
        path : 'instructions', component: InstructionsComponent
    },
    {
        path : 'rallies', component: RalliesComponent
    },
    {
        path : 'rallies/:rallyId', component: RallyComponent
    },
    {
        path : 'sites/:siteId', component: SiteComponent
    },
    {
        path : 'forgot', component: ForgotPasswordComponent
    },
    {
        path : 'sites/:siteId', component: SiteComponent
    },
    {
        path : 'token/:tokenValue', component: TokenLandingComponent
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
