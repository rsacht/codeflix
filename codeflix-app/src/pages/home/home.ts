import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import {Auth} from "../../decorators/auth.decorator";
import {AuthHttp} from "angular2-jwt";
import 'rxjs/add/operator/toPromise';

@Auth()
@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

    constructor(public navCtrl: NavController, public authHttp:AuthHttp ) {

    }

    ionViewDidLoad(){
        setInterval(() =>{
            this.authHttp.get('http://codeflix.app/api/user')
            .toPromise()
            .then(() =>{
                console.log('primeira');
            });
            this.authHttp.get('http://codeflix.app/api/user')
                .toPromise()
                .then(() =>{
                    console.log('segunda');
                });
            this.authHttp.get('http://codeflix.app/api/user')
                .toPromise()
                .then(() =>{
                    console.log('terceira');
                });
        }, 60*1000+1);
    }
}