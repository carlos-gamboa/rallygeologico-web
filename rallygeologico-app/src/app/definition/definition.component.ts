import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Params, Router} from "@angular/router";
import {TermService} from "../services/term.service";
import {Term} from "../model/term";
import {Multimedia} from "../model/multimedia";

import {environment} from "../../environments/environment";
import {User} from "../model/user";
import {UserService} from "../services/user.service";
import {DataService} from "../services/data/data.service";
import {
    AccessibilityConfig, Action, AdvancedLayout, ButtonEvent,
    ButtonsConfig, ButtonsStrategy, ButtonType,
    Description, DescriptionStrategy,
    DotsConfig,
    GalleryService, GridLayout,
    Image, ImageModalEvent,
    LineLayout,
    PlainGalleryConfig,
    PlainGalleryStrategy, PreviewConfig
} from "angular-modal-gallery";
@Component({
  selector: 'app-definition',
  templateUrl: './definition.component.html',
  styleUrls: ['./definition.component.css']
})
export class DefinitionComponent implements OnInit {

    termId:number;
    term:Term = null;
    readyToshow:boolean = false;
    imagesMultimedia:Multimedia[]=[];
    videosMultimedia:Multimedia[]=[];
    assetsUrl: string;

    user: User;
    imagesHtmlDescriptions: Image[] = [];
    imageIndex = 1;
    galleryId = 1;

    constructor(private termService: TermService,
              private route: ActivatedRoute,
              private router: Router, private userService: UserService, private dataService: DataService, private galleryService: GalleryService) {
        this.user = this.dataService.getUser();
        if (!this.user){
            this.userService.isLoggedIn().subscribe((users: User) => {
                if(users[0]){
                    this.dataService.updateUser(users[0]);
                    this.user = users[0];
                  }
            });
        }
        this.setData();
    }

    ngOnInit() {

    }

    setData(){
        this.assetsUrl = environment.assetsUrl;
        this.route.params
            .subscribe((params: Params) => {
                this.termId = this.route.snapshot.params['definitionId'];
                console.log(this.termId);
                this.termService.getATerm(this.termId).subscribe((term:Term) =>{
                    this.term = term;
                    this.setMultimedia();
                    console.log(term);
                    this.readyToshow = true;
                })
            });
    }

    setMultimedia(){
        for(let media of this.term.multimedia){
            if(media.media_type == 0){
                this.imagesMultimedia.push(media);
            }

            // if(media.media_type == 1){
            //     this.videosMultimedia.push(media);
            // }
        }

        let index = 1;
        for (let image of this.imagesMultimedia){
            //TODO  cambiar el extUrl
            let newImage:Image = new Image(index,{img:image.media_url,extUrl:"http://www.google.com",description:image.name});
            this.imagesHtmlDescriptions.push(newImage);
            index++;
        }
    }


    customPlainGalleryRowConfig: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.CUSTOM,
        layout: new AdvancedLayout(-1, true)
    };

    customPlainGalleryColumnConfig: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.CUSTOM,
        layout: new AdvancedLayout(-1, true)
    };

    customPlainGalleryRowDescConfig: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.CUSTOM,
        layout: new AdvancedLayout(-1, true)
    };

    plainGalleryRow: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.ROW,
        layout: new LineLayout({ width: '80px', height: '80px' }, { length: 2, wrap: true }, 'flex-start')
    };
    plainGalleryRowSpaceAround: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.ROW,
        layout: new LineLayout({ width: '50px', height: '50px' }, { length: 2, wrap: true }, 'space-around')
    };
    plainGalleryRowATags: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.ROW,
        layout: new LineLayout({ width: '95px', height: '63px' }, { length: 4, wrap: true }, 'flex-start'),
        // when advanced is defined, additionalBackground: '50% 50%/cover' will be used by default.
        // I added this here, to be more explicit.
        advanced: { aTags: true, additionalBackground: '50% 50%/cover' }
    };

    plainGalleryColumn: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.COLUMN,
        layout: new LineLayout({ width: '50px', height: '50px' }, { length: 3, wrap: true }, 'flex-start')
    };

    plainGalleryGrid: PlainGalleryConfig = {
        strategy: PlainGalleryStrategy.GRID,
        layout: new GridLayout({ width: '33%', height: '33%' }, { length: 3, wrap: true })
    };


    dotsConfig: DotsConfig = {
        visible: false
    };

    customDescription: Description = {
        strategy: DescriptionStrategy.ALWAYS_VISIBLE,
        imageText: '',
        numberSeparator: ' / ',
        beforeTextDescription: ' : '
    };


    // default buttons but extUrl will open the link in a new tab instead of the current one
    // this requires to specify all buttons manually (also if they are not really custom)
    customButtonsConfigExtUrlNewTab: ButtonsConfig = {
        visible: true,
        strategy: ButtonsStrategy.CUSTOM,
        buttons: [
            {
                className: 'ext-url-image',
                type: ButtonType.EXTURL,
                extUrlInNewTab: true // <--- this is the important thing to understand this example
            },
            {
                className: 'close-image',
                type: ButtonType.CLOSE
            }
        ]
    };

    previewConfigOneImage: PreviewConfig = {
        visible: true,
        number: 1
    };

    previewConfigNoArrows: PreviewConfig = {
        visible: true,
        arrows: false
    };

    previewConfigNoClickable: PreviewConfig = {
        visible: true,
        clickable: false
    };

    // TODO still not implemented
    previewConfigAlwaysCenter: PreviewConfig = {
        visible: true
    };

    previewConfigCustomSize: PreviewConfig = {
        visible: true,
        size: { width: '30px', height: '30px' }
    };

    accessibilityConfig: AccessibilityConfig = {
        backgroundAriaLabel: 'CUSTOM Modal gallery full screen background',
        backgroundTitle: 'CUSTOM background title',

        plainGalleryContentAriaLabel: 'CUSTOM Plain gallery content',
        plainGalleryContentTitle: 'CUSTOM plain gallery content title',

        modalGalleryContentAriaLabel: 'CUSTOM Modal gallery content',
        modalGalleryContentTitle: 'CUSTOM modal gallery content title',

        loadingSpinnerAriaLabel: 'CUSTOM The current image is loading. Please be patient.',
        loadingSpinnerTitle: 'CUSTOM The current image is loading. Please be patient.',

        mainContainerAriaLabel: 'CUSTOM Current image and navigation',
        mainContainerTitle: 'CUSTOM main container title',
        mainPrevImageAriaLabel: 'CUSTOM Previous image',
        mainPrevImageTitle: 'CUSTOM Previous image',
        mainNextImageAriaLabel: 'CUSTOM Next image',
        mainNextImageTitle: 'CUSTOM Next image',

        dotsContainerAriaLabel: 'CUSTOM Image navigation dots',
        dotsContainerTitle: 'CUSTOM dots container title',
        dotAriaLabel: 'CUSTOM Navigate to image number',

        previewsContainerAriaLabel: 'CUSTOM Image previews',
        previewsContainerTitle: 'CUSTOM previews title',
        previewScrollPrevAriaLabel: 'CUSTOM Scroll previous previews',
        previewScrollPrevTitle: 'CUSTOM Scroll previous previews',
        previewScrollNextAriaLabel: 'CUSTOM Scroll next previews',
        previewScrollNextTitle: 'CUSTOM Scroll next previews'
    };

    openImageModalRow(image: Image) {
        console.log('Opening modal gallery from custom plain gallery row, with image: ', image);
        const index: number = this.getCurrentIndexCustomLayout(image, this.imagesHtmlDescriptions);
        this.customPlainGalleryRowConfig = Object.assign({}, this.customPlainGalleryRowConfig, { layout: new AdvancedLayout(index, true) });
    }

    openImageModalColumn(image: Image) {
        console.log('Opening modal gallery from custom plain gallery column, with image: ', image);
        const index: number = this.getCurrentIndexCustomLayout(image, this.imagesHtmlDescriptions);
        this.customPlainGalleryColumnConfig = Object.assign({}, this.customPlainGalleryColumnConfig, { layout: new AdvancedLayout(index, true) });
    }


    onButtonBeforeHook(event: ButtonEvent) {
        console.log('onButtonBeforeHook ', event);

        if (!event || !event.button) {
            return;
        }

        // Invoked after a click on a button, but before that the related
        // action is applied.
        // For instance: this method will be invoked after a click
        // of 'close' button, but before that the modal gallery
        // will be really closed.

        if (event.button.type === ButtonType.DELETE) {
            // remove the current image and reassign all other to the array of imagesHtmlDescriptions

            console.log('delete in app with imagesHtmlDescriptions count ' + this.imagesHtmlDescriptions.length);

            this.imagesHtmlDescriptions = this.imagesHtmlDescriptions.filter((val: Image) => event.image && val.id !== event.image.id);
        }
    }

    onButtonAfterHook(event: ButtonEvent) {
        console.log('onButtonAfterHook ', event);

        if (!event || !event.button) {
            return;
        }

        // Invoked after both a click on a button and its related action.
        // For instance: this method will be invoked after a click
        // of 'close' button, but before that the modal gallery
        // will be really closed.
    }

    onCustomButtonBeforeHook(event: ButtonEvent, galleryId: number | undefined) {
        console.log('onCustomButtonBeforeHook with galleryId=' + galleryId + ' and event: ', event);
        if (!event || !event.button) {
            return;
        }
        // Invoked after a click on a button, but before that the related
        // action is applied.

        if (event.button.type === ButtonType.CUSTOM) {
            console.log('adding a new random image at the end');
            this.addRandomImage();

            setTimeout(() => {
                this.galleryService.openGallery(galleryId, this.imagesHtmlDescriptions.length - 1);
            }, 0);
        }
    }

    onCustomButtonAfterHook(event: ButtonEvent, galleryId: number | undefined) {
        console.log('onCustomButtonAfterHook with galleryId=' + galleryId + ' and event: ', event);
        if (!event || !event.button) {
            return;
        }
        // Invoked after both a click on a button and its related action.
    }

    onImageLoaded(event: ImageModalEvent) {
        // angular-modal-gallery will emit this event if it will load successfully input imagesHtmlDescriptions
        console.log('onImageLoaded action: ' + Action[event.action]);
        console.log('onImageLoaded result:' + event.result);
    }

    onVisibleIndex(event: ImageModalEvent) {
        console.log('onVisibleIndex action: ' + Action[event.action]);
        console.log('onVisibleIndex result:' + event.result);
    }

    onIsFirstImage(event: ImageModalEvent) {
        console.log('onIsFirstImage onfirst action: ' + Action[event.action]);
        console.log('onIsFirstImage onfirst result:' + event.result);
    }

    onIsLastImage(event: ImageModalEvent) {
        console.log('onIsLastImage onlast action: ' + Action[event.action]);
        console.log('onIsLastImage onlast result:' + event.result);
    }

    onCloseImageModal(event: ImageModalEvent) {
        console.log('onClose action: ' + Action[event.action]);
        console.log('onClose result:' + event.result);
        // reset custom plain gallery config
        this.customPlainGalleryRowConfig = Object.assign({}, this.customPlainGalleryRowConfig, { layout: new AdvancedLayout(-1, true) });
        this.customPlainGalleryColumnConfig = Object.assign({}, this.customPlainGalleryColumnConfig, { layout: new AdvancedLayout(-1, true) });
        this.customPlainGalleryRowDescConfig = Object.assign({}, this.customPlainGalleryRowDescConfig, { layout: new AdvancedLayout(-1, true) });
    }

    addRandomImage() {
        const imageToCopy: Image = this.imagesHtmlDescriptions[Math.floor(Math.random() * this.imagesHtmlDescriptions.length)];
        const newImage: Image = new Image(this.imagesHtmlDescriptions.length - 1 + 1, imageToCopy.modal, imageToCopy.plain);
        this.imagesHtmlDescriptions = [...this.imagesHtmlDescriptions, newImage];
    }

    openModalViaService(id: number | undefined, index: number) {
        console.log('opening gallery with index ' + index);
        this.galleryService.openGallery(id, index);
    }

    trackById(index: number, item: Image) {
        return item.id;
    }

    private getCurrentIndexCustomLayout(image: Image, imagesHtmlDescriptions: Image[]): number {
        return image ? imagesHtmlDescriptions.indexOf(image) : -1;
    }

}
