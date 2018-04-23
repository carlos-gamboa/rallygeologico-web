import { Injectable } from '@angular/core';

@Injectable()
export class Configuration {
    public Server = 'http://localhost/';
    public ApiUrl = 'rallygeologico/rallygeologico-ws/';
    public ServerWithApiUrl = this.Server + this.ApiUrl;
}