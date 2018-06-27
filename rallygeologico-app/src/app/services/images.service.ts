import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Configuration} from "./data/constants";

@Injectable()
export class ImagesService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    constructor(private http: HttpClient, private _configuration: Configuration) {
        this.baseUrl = this._configuration.ServerWithApiUrl;
        //this.headers.append('Access-Control-Allow-Origin', ['http://localhost:4200', 'http:/localhost']);
    }

    uploadImage(newFileName: string, file: File) {
        this.headers.append('Content-Type', 'multipart/form-data');
        let formData: FormData = new FormData();
        formData.append('file', file);
        return this.http.post<boolean>(this.baseUrl + "multimedia/uploadImage/" + newFileName + ".json", formData,
            { headers: this.headers, withCredentials: true});
    }
}