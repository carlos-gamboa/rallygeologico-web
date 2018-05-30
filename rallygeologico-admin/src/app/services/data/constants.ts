import { Injectable } from '@angular/core';
import {environment} from "../../../environments/environment";

@Injectable()
export class Configuration {
    public Server = environment.server;
    public ApiUrl = environment.apiUrl;
    public ServerWithApiUrl = this.Server + this.ApiUrl;
}