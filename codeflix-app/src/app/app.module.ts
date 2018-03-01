import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';

import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';
import { ListPage } from '../pages/list/list';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import {LoginPage} from "../pages/login/login";
import {Http, HttpModule, XHRBackend} from "@angular/http";
import { JwtClientProvider } from '../providers/jwt-client/jwt-client';
import {IonicStorageModule, Storage} from "@ionic/storage";
import {AuthConfig, AuthHttp, JwtHelper} from "angular2-jwt";
import { AuthProvider } from '../providers/auth/auth';
import {HttpClientModule} from "@angular/common/http";
import {Env} from "../models/env";
import { DefaultXhrBackendProvider } from '../providers/default-xhr-backend/default-xhr-backend';

declare var ENV:Env;

@NgModule({
  declarations: [
    MyApp,
    HomePage,
    ListPage,
      LoginPage
  ],
  imports: [
      HttpModule,
    BrowserModule,
    IonicModule.forRoot(MyApp, {}, {
        links:[
            {component:LoginPage, name: 'LoginPage', segment: 'login'},
            {component:HomePage, name: 'HomePage', segment: 'home'}
        ]
      }),
      HttpClientModule,
      IonicStorageModule.forRoot({
          driverOrder:['localstorage']
      }),
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    ListPage,
      LoginPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    JwtClientProvider,
      JwtHelper,
    AuthProvider,
      {provide: ErrorHandler, useClass: IonicErrorHandler},
      {
          provide: AuthHttp,
          deps:[Http, Storage],
          useFactory(http,storage){
              let authConfig = new AuthConfig({
                  headerPrefix: 'Bearer',
                  noJwtError: true,
                  noClientCheck: true,
                  tokenGetter: (() => storage.get(ENV.TOKEN_NAME))
              });
              return new AuthHttp(authConfig,http);
          }
      },
      {provide: XHRBackend, useClass: DefaultXhrBackendProvider},
  ]
})
export class AppModule {}
