import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";

@Injectable()
export class ImagesService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    constructor(private http: HttpClient, private _configuration: Configuration) {
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    uploadImage(file: File):Observable<boolean>{
        if(file.type == "image/jpeg"){
            this.headers.append('Content-Type', 'image/jpeg');
        }
        else if(file.type == "image/png"){
            this.headers.append('Content-Type', 'image/png');
        }
        else if(file.type == "image/svg"){
            this.headers.append('Content-Type', 'image/svg');
        }
        //console.log(this.baseUrl+"rallygeologico/rallygeologico-ws");
        return this.http.post<boolean>(this.baseUrl+"multimedia/upload/"+file.name, file,
            { headers: this.headers, withCredentials: true });
    }
}