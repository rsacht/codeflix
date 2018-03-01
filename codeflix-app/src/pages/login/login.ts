import { Component } from '@angular/core';
import {IonicPage, MenuController, NavController, NavParams, ToastController} from 'ionic-angular';
import 'rxjs/add/operator/toPromise';
import {AuthProvider} from "../../providers/auth/auth";
import {HomePage} from "../home/home";


/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
    user = {
        email:'admin@user.com',
        password:'secret'
    };

  constructor(
      public navCtrl: NavController,
      public menuCtrl: MenuController,
      public toastCtrl: ToastController,
      public navParams: NavParams,
      private auth:AuthProvider
  ){
      this.menuCtrl.enable(false);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
  }

  login(){
      this.auth.login(this.user)
          .then((user)=>{
              //redirecionar
              this.afterLogin(user);
          })
          .catch(()=>{
          let  toast = this.toastCtrl.create({
              message: 'E-mail ou senha inválidos!',
              duration: 3000,
              position: 'top',
              cssClass: 'toast-login-error',
          });
          toast.present();
      })
  }

  goHome(){
      this.navCtrl.push(HomePage);
  }
    afterLogin(user){
        this.menuCtrl.enable(true);
        this.navCtrl.push(HomePage);
    }


}
