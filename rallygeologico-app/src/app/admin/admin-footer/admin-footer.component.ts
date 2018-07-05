import {Component, OnInit, ViewChild} from '@angular/core';
import {Configuration} from "../../services/data/constants";
import {ImageUploadComponent} from "angular2-image-upload";
import {ImagesService} from "../../services/images.service";
import {environment} from "../../../environments/environment";
import {MultimediaService} from "../../services/multimedia.service";
import {Multimedia} from "../../model/multimedia";

@Component({
  selector: 'app-admin-footer',
  templateUrl: './admin-footer.component.html',
  styleUrls: ['./admin-footer.component.css']
})
export class AdminFooterComponent implements OnInit {

    readyToShow: boolean;
    assetsUrl: string;
    baseUrl: string;
    qrUrl: string;
    link: string;
    editMode: boolean;
    changesSaved: boolean;
    messageType: boolean;
    alertMessage: string;
    imageEvent: any;
    file: File;
    newFileName: string;
    error: boolean;
    qr: Multimedia;

    @ViewChild('inputImage') inputImage: ImageUploadComponent;

    customStyle = {
        selectButton: {
            "background-color": "#0C344E",
            "color": "#FFF",
            "font-size": "14px",
            "text-transform": "capitalize",
        },
        clearButton: {
            "background-color": "#249DD8",
            "color": "#FFF",
            "font-size": "14px",
            "margin": "5px",
            "text-transform": "capitalize",
        },
        layout: {
            "background-color": "#FFF",
            "color": "#555555",
            "font-size": "14px",
            "margin": "10px",
            "padding-top": "5px",
            "width": "98%",
            "border": "#777777 solid 1px",
            "border-radius": "0px"
        },
        previewPanel: {
            "background-color": "#FFF",
        }
    };

    constructor(private _configuration: Configuration, private imageService: ImagesService, private multimediaService: MultimediaService) {
        this.assetsUrl = environment.assetsUrl;
        this.baseUrl = _configuration.ServerWithApiUrl+"webroot/img/";
        this.multimediaService.getQrMultimedia().subscribe((multimedia: Multimedia[]) => {
            if(multimedia[0]){
                this.qr = multimedia[0];
                this.qrUrl = this.qr.media_url;
                this.link = this.qr.external_url;
            } else {
                this.error = true;
                this.messageType = false;
                this.alertMessage = "Error al cargar el Qr.";
            }

        });
        this.editMode = false;
        this.changesSaved = false;
        this.readyToShow = true;

    }

    ngOnInit() {
    }

    /**
     * Sets the flags to show the Qr manager
     */
    adminQr(){
        this.readyToShow = false;
        this.editMode = true;
        this.changesSaved = false;
        this.readyToShow = true;
    }

    /**
     * Gets the selected file and creates its url
     * @param event
     */
    onUpload(event) {
        this.readyToShow = false;
        this.error = false;
        this.changesSaved = false;
        this.imageEvent = event;
        this.file  = event.file;
        let fileName = this.file.name;
        let type = this.file.type;
        if(type == "image/jpeg") {
            if(fileName.includes('.jpeg')){
                this.newFileName = Date.now().toString()+'.jpeg';
            } else if(fileName.includes('.jpg')) {
                this.newFileName = Date.now().toString() + '.jpg';
            }
            this.qrUrl = this.baseUrl + this.newFileName;
        } else if(type == "image/png") {
            this.newFileName = Date.now().toString()+'.png';
            this.qrUrl = this.baseUrl + this.newFileName;
        }
        else if (type == "image/svg"){
            this.newFileName = Date.now().toString()+'.svg';
            this.qrUrl = this.baseUrl + this.newFileName;
        } else {
            if(this.qr != null) {
                this.qrUrl = this.qr.media_url;
                this.imageEvent = null;
            } else{
                this.qrUrl = "";
            }
        }
        this.readyToShow = true;
    }

    /**
     * Verifies if there is a selected file, otherwise change to the initial url
     * @param event
     */
    updateUrl(event){
        this.readyToShow = false;
        if (this.inputImage.fileCounter == 0){
            if(this.qr != null) {
                this.qrUrl = this.qr.media_url;
                this.imageEvent = null;
            } else{
                this.qrUrl = "";
                this.imageEvent = null;
            }
        }
        this.readyToShow = true;
    }

    /**
     * Updates the current Qr link
     */
    saveChanges(){
        this.readyToShow = false;
        this.changesSaved = false;
        if(this.qrUrl == null || this.qrUrl == ""){
            this.alertMessage = "No se pudo guardar los cambios, debe seleccionar una imagen.";
            this.messageType = false;
            this.changesSaved = true;
        }
        else {
            this.imageService.uploadImage(this.newFileName, this.file).subscribe((uploaded: boolean) => {
                if (uploaded) {
                    this.multimediaService.editMultimedia(this.qr.id, this.qr.name, this.qr.media_type, this.qrUrl, this.link).subscribe((multimedia: Multimedia) => {
                        if (multimedia) {
                            this.qr = multimedia;
                            this.qrUrl = this.qr.media_url;
                            this.link = this.qr.external_url;
                            this.imageEvent = null;
                            this.changesSaved = true;
                            this.messageType = true;
                            this.alertMessage = "Se han guardado los cambios.";
                        } else {
                            this.alertMessage = "No se pudo guardar los cambios.";
                            this.messageType = false;

                        }
                    });
                } else {
                    this.error = true;
                    this.messageType = false;
                    this.alertMessage = "No se pudo cargar la imagen.";
                }
            });
        }
        this.editMode = false;
        this.readyToShow = true;
    }
}
